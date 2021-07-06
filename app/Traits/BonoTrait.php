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
        $referidos = User::find(Auth::user()->id)->children;
        if(count($referidos) >= 500){
            dd("Se cumple la condición, se gana el carro");
        }else{
            dd("NO cumple la condición para ganarse el carro");
        }
    }

    public function bonoMotorBike()
    {
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         ******************************************************************/
        $referidos = User::find(Auth::user()->id)->children;
        if(count($referidos) >= 100){
            dd("Se cumple la condición, se gana la motocicleta");
        }else{
            dd("NO cumple la condición para ganarse la motocicleta");
        }
    }

    public function bonoTravel()
    {
        /******************************************************************
         •Cuando complete los 50 referidos recibirá adicional un viaje a
          San andres para 1 persona todo incluido, si esos 50 referidos
          los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
          aplicara para 2 personas todo incluido.
         ******************************************************************/

        $user = User::find(Auth::user()->id);
        if(count($user->children) >= 50){
            if($user->created_at->diffInDays(Carbon::now()) <= 90){
                dd("Cumple los requisitos y se gana el viaje para 2 personas");
            }
            dd("Cumple los requisitos y se gana el viaje para 1 persona");
        }else{
            dd("No tiene suficientes referidos");
        }
    }
}