<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Session;
use Cookie;
use DB;
use Redirect;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminlogin(Request $request)
    {   
        $input = $request->all();
        $email= $input['email'];
         
        $validator= Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            
        ]);
        if($validator->fails()){
           return Redirect::back()->withErrors(['message' =>'Remember Me Check']);  
        }
       
         

        $remember_me = $request->has('remember_me') ? true : false;
      
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role_id == 'admin' and auth()->user()->email == $input['email']) {
                return redirect()->route('home')->with('success', 'You are now logged in.');
            }else{
              return redirect()->route('/')->with('warning','Please enter valid login credentials.');
            }
        }else{
             return Redirect::back()->with('warning','Please enter valid login credentials.');
        }
    
          
    }
}
