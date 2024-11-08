<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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

    //User login with loginId wise...
    public function login(Request $request)
    {
       
        $request->validate([
            'login_id' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        //To check request role...
        $roleData = $request->role;

        if($roleData == 'superadmin'){
            $loginId = 'sp-'.$request->login_id;
        }elseif($roleData == 'admin'){
            $loginId = 'ad-'.$request->login_id;
        }elseif($roleData == 'accountent'){
            $loginId = 'ac-'.$request->login_id;
        }elseif($roleData == 'teacher'){
            $loginId = 'tc-'.$request->login_id;
        }elseif($roleData == 'librarian'){
            $loginId = 'lb-'.$request->login_id;
        }elseif($roleData == 'student'){
            $loginId = 'st-'.$request->login_id;
        }elseif($roleData == 'guardian'){
            $loginId = 'gd-'.$request->login_id;
        }else{
            $loginId = null;
        }
       
        //To check user is avaiable or not with loginId...
        $singleUser = User::where('login_id', $loginId)->first();

        //to check user is available or not...
        if(isset($singleUser) && $singleUser != null){
            //To login with login_id...
            if($this->guard()->attempt(['login_id' => $loginId, 'password' => $request->password], $request->remember)) {
                return redirect()->route('home');
            }else{
                Toastr::error('Error !! Someting Is Wrong.', 'Error', ["progressbar" => true]);
                return redirect()->route('login');
            }

        }else{
            Toastr::error('Error !! User Not Validate.', 'Error', ["progressbar" => true]);
            return redirect()->route('login');
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
