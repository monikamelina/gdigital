<?php

namespace App\Listeners;

use Illuminate\Events\Dispatcher;
use App\Events\ContactUpdate;
use App\Events\ContactDelete;
use DB;

class ActiveCampaignEventSubscriber
{
    
    /**
     * [$ac description]
     * @var [type]
     */
    private $ac;

    function __construct(\ActiveCampaign $ac){
         $this->ac = $ac;
    }


    /**
     * [onUpdateOrCreate description]
     * @param  ContactUpdate $event [description]
     * @return [type]               [description]
     */
    public function onUpdateOrCreate(ContactUpdate $event) {
         
        $contact = $event->contact;
        
        $list_id = $contact->user->list;
        
        $data = array(
            "email"              => $contact->email,
            "first_name"         => $contact->name,
            "last_name"          => $contact->surname,
            "phone"              => $contact->phone,
            "p[{$list_id}]"      => $list_id,
            "status[{$list_id}]" => 1,          // "Active" status
        );

        /*
        Tag-Field created per user possible??
         foreach ($contact->fields as $key => $field) {
            $data['field[%'.$field->name.'%,0]']=$field->value;
        }
        */
        $response = $this->ac->api("contact/sync", $data);
        
        if ((int)$response->success) {

            $id = (int)$response->subscriber_id;

            DB::table('contacts')->where([
                    ['id', $contact->id],
            ])->update(['subscriber_id'=>$id]);                          
        }
    }

    /**
     * [onContactDelete description]
     * @param  ContactDelete $event [description]
     * @return [type]               [description]
     */
    public function onContactDelete(ContactDelete $event) {
        
        $contact = $event->contact;
        $response = $this->ac->api("contact/delete?id=".$contact->subscriber_id);
    }

    /**
     * [onContactUnsubscribe description]
     * @param  ContactDelete $event [description]
     * @return [type]               [description]
     */
    public function onContactUnsubscribe(ContactDelete $event) {
         
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe(Dispatcher $events)
    {

        $events->listen(
            \App\Events\ContactUpdate::class,
            'App\Listeners\ActiveCampaignEventSubscriber@onUpdateOrCreate'
        );

        $events->listen(
            \App\Events\ContactDelete::class,
            'App\Listeners\ActiveCampaignEventSubscriber@onContactDelete'
        );

        $events->listen(
            \App\Events\ContactUnsubscribe::class,
            'App\Listeners\ActiveCampaignEventSubscriber@onContactUnsubscribe'
        );
    }

}