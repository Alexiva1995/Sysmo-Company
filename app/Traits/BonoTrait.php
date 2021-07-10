<?php
namespace App\Traits;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait BonoTrait{

    public function bonoDirecto($producto)
    {
        /******************************************************************
         •El bono directo sera  cada paquere rs pagara 50 usd y cada pro pagara 70. 
         ******************************************************************/
        try {
            $padre = User::find(Auth::user()->id)->referred_id;
            $idProducto = $producto;
            if((User::find($padre)->created_at)->diffInDays(Carbon::now()) <= 365)//Validez por 1 año
            {
                if($idProducto == 1){
                    Wallet::create([
                        'user_id' => User::find($padre)->id,
                        'bonus_id' => 4,
                        'amount' => 50,
                        'description' => 'Ganó 1 Bono Direct de 50$USD',
                        'status' => 2
                    ]);
                    Storage::append("BonoDirecto.txt", 'Se genera el pago de 50$USD al usuario: ' . $padre);
                }elseif($idProducto == 2){
                    Wallet::create([
                        'user_id' => User::find($padre)->id,
                        'bonus_id' => 4,
                        'amount' => 70,
                        'description' => 'Ganó 1 Bono Direct de 70$USD',
                        'status' => 2
                    ]);
                    Storage::append("BonoDirecto.txt", 'Se genera el pago de 70$USD al usuario: ' . $padre);
                }
            }
            // else{
            //     Storage::append("BonoDirecto.txt", 'Se venció el bono directo al usuario: ' . $padre);
            // }
           
        } catch (\Throwable $th) {
            Storage::append("BonoDirecto.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }

    
    public function showBonoMoney()
    {
        $bonoDirecto = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 1);
        
        if($bonoDirecto){
            return count($bonoDirecto);
        }else{
            return 0;
        }
    }

    public function showBonoRapido()
    {
        $bonoRapido = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 2);

        if($bonoRapido){
            return count($bonoRapido);
        }else{
            return 0;
        }
    }

    public function showBonoInicio()
    {
        $bonoInicio = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 3);

        if($bonoInicio){
            return count($bonoInicio);
        }else{
            return 0;
        }
    }
    
    public function showBonoDirecto()
    {
        $bonoDirecto = Wallet::all()->where('referred_id', '=', Auth::user()->id)->where('bonus_id', '=', 5);

        if($bonoDirecto){
            return count($bonoDirecto);
        }else{
            return 0;
        }
    }

    public function showBonoViaje()
    {
        $bonoViaje = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 5);

        if($bonoViaje){
            return count($bonoViaje);
        }else{
            return 0;
        }
    }

    public function showBonoMoto()
    {
        $bonoMoto = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 6);

        if($bonoMoto){
            return count($bonoMoto);
        }else{
            return 0;
        }
    }

    public function showBonoCarro()
    {
        $bonoCarro = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 7);

        if($bonoCarro){
            return count($bonoCarro);
        }else{
            return 0;
        }
    }




    
    public function bonoMoney()
    {
        /******************************************************************
         Cada 10 referidos directos que compren paquete se pagara 100usd
         ******************************************************************/
        try {
            $user = User::find(Auth::user()->id);
            /******************************** */
            $padre = $user->referred_id;
                                                //Dependiendo de la manera en que se llame el método, se activan o no estas variables
            $user = User::find($padre);
            /******************************* */
            // dd($user);
            $totalOrdenes = [];

            foreach($user->children as $referido){
                if($referido->getOrder->isNotEmpty()){
                    array_push($totalOrdenes, $referido->getOrder);
                }
            }
            $iterador = intval(ceil(count($totalOrdenes)/10)*10);
            $totalOrdenes = count($totalOrdenes);
        if($totalOrdenes != 0){
            if($totalOrdenes == $iterador){
                Wallet::create([
                    'user_id' => User::find($user)->id,
                    'bonus_id' => 1,
                    'ammount' => 100,
                    'description' => 'Ganó 1 Bono Money',
                    'status' => 2
                ]);
                Storage::append("BonoMoney.txt", $padre .'Ganó 1 Bono Money de 100$USD');
            }
            else{
                return 'Tus referidos no han comprado los paquetes suficientes, tienes ' . $totalOrdenes . ' de ' . $iterador;
            }
        }
        else{
             return 'Ninguno de tus referidos ha comprado paquetes';
        }
            
        } catch (\Throwable $th) {
            Storage::append("BonoMoney.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }

    // public function bonoCarLifeStyle()
    // {
    //     /******************************************************************
    //      •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 
    //      ******************************************************************/
    //     try {
    //         $alluser = count(User::all());
    //         // dd($alluser);
    //         dd(Wallet::where([['user_id', User::find(7)->id],['bonus_id', 7]])->count());
    //         for($i = 1; $i <= $alluser; $i++){
    //             $referidos = User::find($i)->children;
    //             if(count($referidos) >= 500){
    //                 echo "<pre>";
    //                 print_r("Usuario ". $i . " si cumple");
    //                 echo "</pre>";
    //                 // return 1;
    //                 // dd("Se cumple la condición, se gana el carro, tienes " .count($referidos) . " de 500");
    //             }else{
    //                 echo "<pre>";
    //                 print_r("Usuario ". $i . " no cumple");
    //                 echo "</pre>";
    //                 // return 0;
    //                 // dd("NO cumple la condición para ganarse el carro, tienes " .count($referidos) . " de 500");
    //             }
    //         }
            
    //     } catch (\Throwable $th) {
    //         dd($th);
    //     }
        
    // }

    // public function bonoMotorBike()
    // {
    //     /******************************************************************
    //      •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
    //      ******************************************************************/
    //     try {
    //         $referidos = User::find(Auth::user()->id)->children;
    //     if(count($referidos) >= 100){
    //         dd("Se cumple la condición, se gana la motocicleta, tienes " . count($referidos). " de 100");
    //     }else{
    //         dd("NO cumple la condición para ganarse la motocicleta, tienes " . count($referidos). " de 100");
    //     }
    //     } catch (\Throwable $th) {
    //         dd($th);
    //     }
        
    // }

//     public function bonoTravel()
//     {
//         /******************************************************************
//          •Cuando complete los 50 referidos recibirá adicional un viaje a
//           San andres para 1 persona todo incluido, si esos 50 referidos
//           los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
//           aplicara para 2 personas todo incluido.
//          ******************************************************************/
//         try {
//             $user = User::find(Auth::user()->id);
//         if(count($user->children) >= 50){
//             if($user->created_at->diffInDays(Carbon::now()) <= 90){
//                 dd("Cumple los requisitos y se gana el viaje para 2 personas, tiene " . count($user->children) . " de 50 referidos");
//             }
//             dd("Cumple los requisitos y se gana el viaje para 1 persona " . count($user->children) . " de 50 referidos");
//         }else{
//             dd("No tiene suficientes referidos para ganarse el viaje, tiene " . count($user->children) . " de 50 referidos");
//         }
//         } catch (\Throwable $th) {
//             dd($th);
//         }
        
//     }

//     public function bonoSpeed()
//     {
//          /******************************************************************
//          •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
//          se le dará como bono el retorno del 100% de los próximos 2 referidos.
//          Nota:(para aplicar a este bono debe tener esos 2 referidos en los Siguientes 15 días)
//          ******************************************************************/
//         try{
//             $user = User::find(Auth::user()->id);
//             /******************************** */
//             // $padre = $user->referred_id;
//                                                 //Dependiendo de la manera en que se llame el método, se activan o no estas variables
//             // $user = User::find($padre);
//             /******************************* */
//             // dd($user);

//             $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(30)] );
//             if(count($referidosRangoFecha) >= 20  ) {

//                     $fechaReferido20 = [];
//                     foreach($user->children as $fecha){
//                         array_push($fechaReferido20, $fecha->created_at); //Crea un array con las fechas de los referidos
//                     }
//                     sort($fechaReferido20, SORT_STRING); //Ordena la colección por fecha

//                     $fechaReferido20 = $fechaReferido20[19]->format('d-m-Y');//El Índice del array tiene que ser 19
//                     $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido20), Carbon::parse($fechaReferido20)->addDays(15)]));//Guarda cuantos referidos se registraron despues de que el referido N°20 se registró hasta 15 días después

//                      if(count($referidosExtra) > 2){
//                         dd('Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 20 se registró el ' . $fechaReferido20 . ', ' .$user->created_at->diffInDays($fechaReferido20) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
//                     }else{
//                         dd("Necesitas al menos 2 referido más antes de la fecha ". Carbon::parse($fechaReferido20)->addDays(30)->format('d-m-Y') ." para ganar el bono");
//                     }
//             }else{
//                 dd("No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenías " . count($referidosRangoFecha) . ' de 20');
//             }

//         } catch (\Throwable $th) {
//             dd($th);
//         }


        
//     }

//     public function bonoStart()
//     {
//         /******************************************************************
//          • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
//          recibirá por su 4 referido un bono extra de 50usd
//          Nota: (para aplicar a esta comisión extra el referido #4 debe
//          traerlo durante los primeros 30 dias)
//          ******************************************************************/

//         try{
//             $user = User::find(Auth::user()->id);

//             $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(15)] );

//             if(count($referidosRangoFecha) >= 3  ) {

//                 $fechaReferido3 = [];
//                     foreach($user->children as $fecha){
//                         array_push($fechaReferido3, $fecha->created_at); //Crea un array con las fechas de los referidos
//                     }
//                     sort($fechaReferido3, SORT_STRING); //Ordena la colección por fecha
//                     $fechaReferido3 = $fechaReferido3[2]->format('d-m-Y');//El Índice del array tiene que ser 2
                    
//                     $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido3), Carbon::parse($fechaReferido3)->addDays(30)]));//Guarda cuantos referidos se registraron despues de que el referido N°3 se registró hasta 30 días después
                    
//                     if(count($referidosExtra) > 1){
//                         dd('Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 3 se registró el ' . $fechaReferido3 . ', ' .$user->created_at->diffInDays($fechaReferido3) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
//                     }else{
//                         dd("Necesitas al menos 1 referido más antes de la fecha ". Carbon::parse($fechaReferido3)->addDays(30)->format('d-m-Y') ." para ganar el bono");
//                     }
//             }else{
//                 dd("No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenías " . count($referidosRangoFecha) . ' de 3');
//             }
//         }catch (\Throwable $th) {
//             dd($th);
//         }
//     }
}