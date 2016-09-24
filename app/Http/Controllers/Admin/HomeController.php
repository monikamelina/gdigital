<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Profile;
use App\Repositories\UserRepository;

class HomeController extends Controller
{
    /**
     * [$user description]
     * @var [type]
     */
    private $user;


    function __construct(UserRepository $user){
        // Refactor to use userRepository?? ...
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $users = User::where('id','!=', auth()->user()->id)->get();

        return  view('admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        $user           = new User;
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->admin    = $request->get('admin');

        $user->profile()->save(new Profile);

        flash('Successfully created user!', 'success');
        return redirect('/admin');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = \App\Contact::with('fields')->where('user_id', $id)->paginate(5);
        $user = User::where('id', $id)->first();

        return view('admin.show', ['contacts'=>$contacts,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // store
        $user             = User::find($id);
        $user->name       = $request->get('name');
        $user->admin      = ($request->get('admin'))? 1 : 0;
        $user->save();

        flash('Successfully updated user!', 'success');
        return redirect('admin');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        flash('Successfully deleted the user!', 'success');
        return redirect('admin');
    }
}
