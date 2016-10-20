<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Input, Validator, Cache, Request;
use App\Http\Models\Users;


class AuthCtrl extends Controller
{
	public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getLogin','postLogin','getChangeLanguage']]);
    }

    public function getChangeLanguage() {
        $locale = Input::get('locale');        
        session(['locale' => $locale]);
        //config(['app.locale' => $locale]);
        return response()->json(['code' => 'success', 'language' => session('locale')]);
    }

	public function getIndex()
    {
		return redirect('auth/login');
    }

    function getLogout() {
    	auth()->logout();
    	return redirect('auth/login');
    }

	public function getLogin() {
		return view('auth/login');
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