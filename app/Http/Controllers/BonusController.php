<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bonus;
use App\Models\BonusPivot;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\BonoTrait;

class BonusController extends Controller
{
    use BonoTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = Bonus::get();
        // dd($bonuses);
        // $this->moneyBonus();
        // $this->speedBonus();
        // $this->startBonus();

        $bonoMoto = $this->bonoMotorBike();
        $bonoCarro = $this->bonoCarLifeStyle();
        $bonoTravel = $this->bonoTravel();
        $bonoMoney = $this->bonoMoney(Auth::user());
        $bonoStart = $this->bonoStart();
        $bonoSpeed = $this->bonoSpeed();

        $bono = [
            'bonoMoto' => $bonoMoto,
            'bonoCarro' => $bonoCarro,
            'bonoTravel' => $bonoTravel,
            'bonoMoney' => $bonoMoney,
            'bonoStart' => $bonoStart,
            'bonoSpeed' => $bonoSpeed
         ];

        $dbBonoMoney = $this->showBonoMoney();
        $dbBonoSpeed = $this->showBonoRapido();
        $dbBonoStart = $this->showBonoInicio();
        $dbBonoDirect = $this->showBonoDirecto();
        $dbBonoTravel = $this->showBonoViaje();
        $dbBonoMoto = $this->showBonoMoto();
        $dbBonoCarro = $this->showBonoCarro();

        $dbBonos = [
           'dbBonoMoney' => $dbBonoMoney,
           'dbBonoSpeed' => $dbBonoSpeed,
           'dbBonoStart' => $dbBonoStart,
           'dbBonoDirect' => $dbBonoDirect,
           'dbBonoTravel' => $dbBonoTravel,
           'dbBonoMoto' => $dbBonoMoto,
           'dbBonoCarro' => $dbBonoCarro,
        ];
// dd($dbBonos['dbBonoTravel']);
        return view('content.bonus.index')->with('bonuses', $bonuses)
                                        ->with('bono', $bono)
                                        ->with('dbBonos', $dbBonos);
    }


    public function logBonus(){
        $bonuses = Wallet::all()->where('bonus_id', '>', 0);
        return view('content.bonus.logBonus')->with('bonuses', $bonuses);
    }

}
