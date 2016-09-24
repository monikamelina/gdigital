<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;

use Datatables;
use App\Contact;
use App\Field;

use App\Events\ContactUpdate;
use App\Events\ContactDelete;

use App\Http\Requests\UserRequest;

use App\Events\SendActivationCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $contacts =  auth()->user()->contacts()->count();
        
        return view('dashboard',compact('contacts'));
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile(){
        return view('user.profile', ['user'=>\Auth::user()]);
    }

    /**
     * [updateProfile description]
     * @param  UserRequest $request [description]
     * @return [type]               [description]
     */
    public function updateProfile(UserRequest $request){

        //Just in case
        $input = $request->except(['email', 'password','_method', '_token']);

        $user = \App\User::with('profile')->find(\Auth::user()->id);

        if(!$user){
            flash('Was an error updating user!', 'error');
            return redirect('/');
        }

        $user->fill($request->all());
        
        $user->profile->fill($request->get('profile'));
       
        $user->push();

        flash('Successfully updated user!', 'success');

        return redirect('/profile');
    }

    /**
     * [store description]
     * @param  ContactRequest $request [description]
     * @return [type]                  [description]
     */
    public function store(ContactRequest $request){

        $data = $request->all();

        $contact = new Contact;

        $contact->name      = $data['name'];
        $contact->surname   = $data["surname"];  
        $contact->email     = $data["email"];  
        $contact->phone     = $data["phone"]; 

        $request->user()->contacts()->save($contact);  

        // Save fields with name && value
        $fields = $this->getFields( $request, $contact->id );
        
        if($fields)
            $contact->fields()->insert($fields);

        event(new ContactUpdate($contact));

        return response()->json(['responseText' => 'Success!', 'status'=>true], 200);
    }

    /**
     * [anyData description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function anyData(Request $request){

        $contacts = auth()->user()->contacts()->with('fields')->get();

        return Datatables::of($contacts)->addColumn('action',  function ($id) {

        return '<a href="#" class="btn btn-sm btn-primary btn-edit" data-edit="' . $id->id . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="#" class="btn btn-sm btn-danger btn-del" data-remove="'.$id->id.'" data-title="Delete" data-toggle="modal" data-target="#del-modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

        })->make(true);
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id){

        $contact = auth()->user()->contacts()->where('id', '=', $id)->with('fields')->first();

        if(!$contact)
             return response()->json(['responseText' => 'Not Found!', 'status'=>false], 404);

        return response()->json($contact);
    }

    /**
     * [update description]
     * @param  Request $reques [description]
     * @param  [type]  $id     [description]
     * @return [type]          [description]
     */
    public function update(ContactRequest $request, $id){
        
        $contact = auth()->user()->contacts()->where('id', '=', $id)->with('fields')->first();

        $contact->name      = $request->name;
        $contact->surname   = $request->surname;
        $contact->email     = $request->email;
        $contact->phone     = $request->phone;

        if(!$contact->save())
            return response()->json(['responseText' => 'Not Found!', 'status'=>false], 404);


        // Save fields with name && value
        $fields = $this->getFields( $request, $contact->id );
        
        if($fields){
            $contact->fields()->delete();
            $contact->fields()->insert($fields);
        }

        event(new ContactUpdate($contact));
        
        return response()->json(['responseText' => 'Success!', 'status'=>true], 200);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id){
       
       $contact = Contact::where([['id','=',$id], ['user_id','=', auth()->user()->id]])->first();

       if(!$contact){
            return response()->json(['responseText' => 'Not Found!', 'status'=>false], 404);
       }
       
       event(new ContactDelete($contact));

       $contact->delete();

       return response()->json(['responseText' => 'Success!', 'status'=>true], 200);
    }

    /**
     * [getFields description]
     * @param  [type] $request    [description]
     * @param  [type] $contact_id [description]
     * @return [type]             [description]
     */
    private function getFields($request, $contact_id){

        $fields = [];
        
        foreach ($request->field as $k => $val) {
            
            // Validate if field have name and value
            if($request->has('field.'.$k.'.name') && $request->has('field.'.$k.'.value')){
                $fields[$k]['name']         = $val['name'];
                $fields[$k]['value']        = $val['value'];
                $fields[$k]['position']     = $k;
                $fields[$k]['contact_id']   = $contact_id;
                $fields[$k]['created_at']   = \Carbon\Carbon::now();
                $fields[$k]['updated_at']   = \Carbon\Carbon::now();
            }
        }

        return $fields;
    }

}
