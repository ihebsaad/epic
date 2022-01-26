<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username  ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest', ['except' => 'logout']);
        $this->username = $this->findUsername();

    }
	
	protected function validateLogin(Request $request)
	{
    $this->validate($request, [
        $this->username() => 'required|string',
        'password' => 'required|string',
        'g-recaptcha-response'=>'required|recaptcha'

    ]);
	}


    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
	
	
	public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }
	
    public function refresh()
    {
         return captcha_img('math');
    }
    
}
