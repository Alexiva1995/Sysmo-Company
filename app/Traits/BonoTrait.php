<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait BonoTrait{

    public function bonoDirecto($producto)
    {
        /******************************************************************
         •El bono directo sera  cada paquere rs pagara 50 usd y cada pro pagara 70. 
         ******************************************************************/
        try {
            $padre = User::find(Auth::user()->id)->referred_id;
            $idProducto = $producto;

            if((User::find(Auth::user()->id)->created_at)->diffInYears(Carbon::now()) <= 1)//Validez por 1 año
            {
                if($idProducto == 1){
                    dd('Se genera el pago de 50$USD al usuario: ' . $padre);
                }elseif($idProducto == 2){
                    dd('Se genera el pago de 70$USD al usuario: ' . $padre);
                }
            }
           
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function bonoCarLifeStyle()
    {
        /******************************************************************
         •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 
         ******************************************************************/
        $users = User::find(Auth::user()->id)->children;
        if(count($users) >= 500){
            dd("Se cumple la condición, se gana el carro");
        }else{
            dd("NO Se cumple la condición");
        }

    }
}