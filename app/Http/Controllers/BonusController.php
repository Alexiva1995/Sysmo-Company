<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bonus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->moneyBonus();
        $this->speedBonus();
        // return view('content.bonus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        //
    }


    public function moneyBonus()
    {
        /******************************************************************
         Cada 10 referidos directos que compren paquete se pagara 100usd
         ******************************************************************/
    
        $referidos = 10; //Referidos que se necesitan para cumplir la condición del bono
        $users = User::find(Auth::user()->id)->children;
        if(count($users) > 0){
            foreach($users as $user){
                if(count($user->getOrder) >= $referidos ){
                     dd("Se cumple la condición y se genera el pago y se aumenta el iterador en +10");
                }else{
                    dd("NO Se cumple la condición");
                }
            }
        }
        
    }

    public function speedBonus()
    {
        /******************************************************************
         •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
         se le dará como bono el retorno del 100% de los próximos 2 referidos.

         Nota:(para aplicar a este bono debe tener esos 2 referidos en los
          Siguientes 15 días)
         ******************************************************************/

         $referidos = 20; //Número de referidos que debe tener para que se cumpla la condición
         $dias = 30; //Días antes de que la condición deje de cumplirse

        $user = User::find(Auth::user()->id);
         $create = $user->created_at;
         
         if($create->diffInDays(Carbon::now()) >= $dias){
            if(count($user->children) >= $referidos){
                dd("Cumple los requisitos para el bono");
            }else{
                dd("No tiene suficientes referidos");
            }
         }else{
            dd("Ya pasaron más de 30 días");
         }
    
    }

    public function startBonus()
    {
        /******************************************************************
         • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
         recibirá por su 4 referido un bono extra de 50usd
         Nota: (para aplicar a esta comisión extra el referido #4 debe
         traerlo durante los primeros 30 dias)
         ******************************************************************/
    }

    public function directBonus()
    {
        /******************************************************************
         El bono directo sera  cada paquere rs pagara 50 usd y cada pro pagara 70
         Los planes tendran vigenci durante 12 meses
         ******************************************************************/
    }

    public function travelBonus()
    {
        /******************************************************************
         •Cuando complete los 50 referidos recibirá adicional un viaje a
          San andres para 1 persona todo incluido, si esos 50 referidos
          los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
          aplicara para 2 personas todo incluido.

          Nota: si el usuario se encuentra fuera de Colombia se le podrá 
          hacer efectivo el valor del viaje.

          el viaje tendrá 60 días para ser redimido. Aplica términos y condiciones.
         ******************************************************************/
    }

    public function motorbikeBonus()
    {
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         
         Nota: la moto será entregada en los siguientes 60 días después de
          cumplir con el requisito. Aplica términos y condiciones.
         ******************************************************************/
    }

    public function carLifeStyleBonus()
    {
        /******************************************************************
         •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 

         Nota: el carro será entregado en los siguientes 60 días después de 
         cumplir con el requisito. Aplica términos y condiciones.
         ******************************************************************/
    }

}
