<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ImpersonateController extends Controller
{
   
    public function start(User $user)
    {
        session()->put('impersonated_by', auth()->id());

        Auth::login($user);

        return redirect()->route('dashboard')->with('message','Te has logueado Exitosamente');

    }

    public function stop()
    {

        Auth::loginUsingId(session()->pull('impersonated_by'));

        return redirect()->route('dashboard')
        ->with('message','Has iniciado seccion Exitosamente');

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
                        $user2 = Auth::user();
                        Auth::login($user2);
                        return redirect()->route('dashboard');
                    }
                }else{
                    $msjwarning = 'Usuario incorrecto';
                }
            }else{
                $msjwarning = 'El usuario no existe';
            }
        return redirect()->route('login')->with('message', $msjwarning);
    }
}