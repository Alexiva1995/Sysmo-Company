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
        try {
            $referidos = User::find(Auth::user()->id)->children;
            if(count($referidos) >= 500){
                dd("Se cumple la condición, se gana el carro");
            }else{
                dd("NO cumple la condición para ganarse el carro");
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function bonoMotorBike()
    {
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         ******************************************************************/
        try {
            $referidos = User::find(Auth::user()->id)->children;
        if(count($referidos) >= 100){
            dd("Se cumple la condición, se gana la motocicleta");
        }else{
            dd("NO cumple la condición para ganarse la motocicleta");
        }
        } catch (\Throwable $th) {
            dd($th);
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
        try {
            $user = User::find(Auth::user()->id);
        if(count($user->children) >= 50){
            if($user->created_at->diffInDays(Carbon::now()) <= 90){
                dd("Cumple los requisitos y se gana el viaje para 2 personas");
            }
            dd("Cumple los requisitos y se gana el viaje para 1 persona");
        }else{
            dd("No tiene suficientes referidos para ganarse el viaje");
        }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function bonoMoney()
    {
        /******************************************************************
         Cada 10 referidos directos que compren paquete se pagara 100usd
         ******************************************************************/
        try {
            
            $user = User::find(Auth::user()->id);
            $referidos = $user->children;
            $totalOrdenes = [];

            foreach($referidos as $referido){
                if($referido->getOrder->isNotEmpty()){
                    array_push($totalOrdenes, $referido->getOrder);
                }
                $iterador = intval(ceil(count($totalOrdenes)/10)*10);
            }

            $totalOrdenes = count($totalOrdenes);

            if(count( $referidos) < intval(ceil(count( $referidos)/10)*10))
            {
                dd("NO Tiene los referidos suficientes, tienes " . count( $referidos) . ' de ' . $iterador);
            }

            if(count( $referidos) == intval(ceil(count($referidos)/10)*10))
            {
                if($totalOrdenes >= $iterador){
                    dd("Tienes " . count( $referidos) . ' de '. $iterador .', se genera el pago de 100');
                }else{
                    dd("Tus referidos no han comprado los suficientes paquetes, tienes:  " . $totalOrdenes . ' de ' . $iterador);
                }
            }

        } catch (\Throwable $th) {
            dd($th);
        }
       
    }

    public function bonoSpeed()
    {
         /******************************************************************
         •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
         se le dará como bono el retorno del 100% de los próximos 2 referidos.
         Nota:(para aplicar a este bono debe tener esos 2 referidos en los Siguientes 15 días)
         ******************************************************************/
        try{
            $user = User::find(Auth::user()->id);

            $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(30)] );

            if(count($referidosRangoFecha) >= 20  ) {

                    $fechaReferido20 = [];
                    foreach($user->children as $fecha){
                        array_push($fechaReferido20, $fecha->created_at); //Crea un array con las fechas de los referidos
                    }
                    sort($fechaReferido20, SORT_STRING); //Ordena la colección por fecha

                    $fechaReferido20 = $fechaReferido20[19]->format('d-m-Y');//El Índice del array tiene que ser 19
                    $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido20), Carbon::parse($fechaReferido20)->addDays(15)]));//Guarda cuantos referidos se registraron despues de que el referido N°20 se registró hasta 15 días después

                     if(count($referidosExtra) > 2){
                        dd('Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 20 se registró el ' . $fechaReferido20 . ', ' .$user->created_at->diffInDays($fechaReferido20) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
                    }else{
                        dd("Necesitas al menos 2 referido más antes de la fecha ". Carbon::parse($fechaReferido20)->addDays(30)->format('d-m-Y') ." para ganar el bono");
                    }
            }else{
                dd("No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenías " . count($referidosRangoFecha) . ' de 20');
            }

        } catch (\Throwable $th) {
            dd($th);
        }


        
    }

    public function bonoStart()
    {
        /******************************************************************
         • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
         recibirá por su 4 referido un bono extra de 50usd
         Nota: (para aplicar a esta comisión extra el referido #4 debe
         traerlo durante los primeros 30 dias)
         ******************************************************************/

        try{
            $user = User::find(Auth::user()->id);

            $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(15)] );

            if(count($referidosRangoFecha) >= 3  ) {

                $fechaReferido3 = [];
                    foreach($user->children as $fecha){
                        array_push($fechaReferido3, $fecha->created_at); //Crea un array con las fechas de los referidos
                    }
                    sort($fechaReferido3, SORT_STRING); //Ordena la colección por fecha
                    $fechaReferido3 = $fechaReferido3[2]->format('d-m-Y');//El Índice del array tiene que ser 2
                    
                    $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido3), Carbon::parse($fechaReferido3)->addDays(30)]));//Guarda cuantos referidos se registraron despues de que el referido N°3 se registró hasta 30 días después
                    
                    if(count($referidosExtra) > 1){
                        dd('Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 3 se registró el ' . $fechaReferido3 . ', ' .$user->created_at->diffInDays($fechaReferido3) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
                    }else{
                        dd("Necesitas al menos 1 referido más antes de la fecha ". Carbon::parse($fechaReferido3)->addDays(30)->format('d-m-Y') ." para ganar el bono");
                    }
            }else{
                dd("No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenías " . count($referidosRangoFecha) . ' de 3');
            }
        }catch (\Throwable $th) {
            dd($th);
        }
    }
}