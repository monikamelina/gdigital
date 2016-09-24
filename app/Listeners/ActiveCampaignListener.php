<?php

namespace App\Listeners;

use App\Events\CreateContactList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveCampaignListener
{
    /**
     * [$ac description]
     * @var [type]
     */
    private $ac;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\ActiveCampaign $ac)
    {
        $this->ac = $ac;
    }

    /**
     * Handle the event.
     *
     * @param  CreateContactList  $event
     * @return void
     */
    public function handle(CreateContactList $event)
    {
        $user = $event->user;

        $id = "list-".$user->id.'-'.$user->email;

        $list = array(
            "name"           => $id,
            "sender_name"    => config('app.name'),
            "sender_addr1"   => env('ACTIVECAMPAIGN_ADDR'),
            "sender_city"    => env('ACTIVECAMPAIGN_CITY'),
            "sender_zip"     => env('ACTIVECAMPAIGN_ZIP'),
            "sender_country" => env('ACTIVECAMPAIGN_COUNTRY'),
        );

        $response = $this->ac->api("list/add", $list);
        
        if ((int)$response->success) {
            $list_id = (int)$response->id;
            \DB::table('users')->where('id', $user->id)->update(['active'=>1, 'list'=>$list_id]);
        }
    }
}
