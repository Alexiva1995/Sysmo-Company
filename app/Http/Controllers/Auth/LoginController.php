<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

    // Login
    public function showLoginForm(){
      $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

      return view('/auth/login', [
          'pageConfigs' => $pageConfigs
      ]);
    }

    /**
     * Permite que el usuario haga login directamente
     *
     * @param Request $request
     * @return void
     */
    public function loginApi(Request $request)
    {
        $iduser = $request->iduser;
        $msjwarning = '';
        if ($iduser > 0) {
            $user = User::where('user_id_crypto', '=', $iduser)->first();
            if (!empty($user)) {
                Auth::loginUsingId($user->id);
                if (Auth::check()) {
                    session(['iduser' => $user->id]);
                    dd(session('iduser'));
                    return redirect()->route('dashboard');
                }
            }else{
                $msjwarning = 'Usuario incorrecto';
            }
        }else{
            $msjwarning = 'El usuario no existe';
        }
        Session::flash('msjwarning', $msjwarning);
        return redirect()->route('login')->with('msjwarning', $msjwarning);
    }
}
