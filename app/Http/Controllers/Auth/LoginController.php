<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function postLogin(AuthRequest $request) {        
        try {
            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'),true)) {
                Users::where('user_id',auth()->user()->user_id)->update(['login_ip' => Request::ip(),'login_at' => time()]);
                return response()->json([
                    'code'     => 'success',
                    'mesage'   => 'Login success', 
                    'comeback' => Input::has('back') ? base64_decode(\Input::get('back')) : url('/home'),
                ]);
            }
            return response()->json(['code' => 'error', 'message' => 'Email or Password invalid.']);

        } catch (Exception $e) {
            return response()->json(['code' => 'error', 'mesage' => $e->getMessage()]);
        }
    }
}
