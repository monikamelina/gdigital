<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Events\CreateContactList;
use App\Events\SendActivationCode;
use Exception;

class AuthController extends Controller {

	/**
	* @var UserRepository
	*/
    private $users;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var Authenticator
     */
    private $auth;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(UserRepository $users, Socialite $socialite,  Authenticator $auth)
	{
		$this->middleware('guest');

        $this->users 		= $users;
        $this->socialite 	= $socialite;
        $this->auth 		= $auth;
	}


	/**
	 * [redirectToProvider description]
	 * @param  [type] $provider [description]
	 * @return [type]           [description]
	 */
    public function redirectToProvider( $provider )
    {
        $service = \Config::get('services.' . $provider);

        if(empty($service))
            return view('pages.missing')->with('error','No such provider');

        return  $this->socialite->driver( $provider )->redirect();
    }

    /**
     * [handleProviderCallback description]
     * @param  [type] $provider [description]
     * @return [type]           [description]
     */
    public function handleProviderCallback( $provider ){
        
       try {

        	$user =  $this->socialite->driver( $provider )->stateless()->user();

        } catch (Exception $e) {
            
            return redirect('auth/login');
        
        }

        $user = $this->users->findOrCreateUser( $user, $provider);

        $user = $this->auth->loginUsingId($user->id, true);
		
        // Create User contact's list
        // Contact list is create it if user is not active
        if( !$user->active ){
            event(new CreateContactList($user));    

            // Send User activation code account
            // On Social registration user doesn't provide password
            // to be able to login with social/credentials
        
            event(new SendActivationCode($user)); 
        }

		if ( !$user )
            abort("Error loggin in", 500);

        return redirect('/');
    }
}