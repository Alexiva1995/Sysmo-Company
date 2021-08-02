<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Wallet;
use App\Traits\BonoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  use BonoTrait;

  public function index()
   { 
    $total = Wallet::where('user_id', '=', Auth::id())
    ->where('bonus_id', '!=', 0)
    ->where('type_transaction', '=', 0)
    ->where('liquidated', '=', 0)
    ->where('status', 0)
    ->sum('amount');

    $bonuses = Bonus::get();
    $bonoMoto = $this->bonoMotorBike();
    $bonoCarro = $this->bonoCarLifeStyle();
    $bonoTravel = $this->bonoTravel();
    $dbBonoTravel = $this->showBonoViaje();
    $dbBonoMoto = $this->showBonoMoto();
    $dbBonoCarro = $this->showBonoCarro();

    $bono = [
      'bonoMoto' => $bonoMoto,
      'bonoCarro' => $bonoCarro,
      'bonoTravel' => $bonoTravel,
   ];


    $dbBonos = [
      'dbBonoTravel' => $dbBonoTravel,
      'dbBonoMoto' => $dbBonoMoto,
      'dbBonoCarro' => $dbBonoCarro,
   ];

     return view('dashboard')
                            ->with('total', $total)
                            ->with('bonuses', $bonuses)
                            ->with('bono', $bono)
                            ->with('dbBonos', $dbBonos);
   }

  //  // Dashboard - Analytics user
  //  public function dashboardAnalyticsUser()
  //  {
  //    $pageConfigs = ['pageHeader' => false];
 
  //    return view('content.dashboard.user.dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  //  }

  // // Dashboard - Analytics
  // public function dashboardAnalytics()
  // {
  //   $pageConfigs = ['pageHeader' => false];

  //   return view('.content.dashboard.admin.dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  // }

  // // Dashboard - Ecommerce
  // public function dashboardEcommerce()
  // {
  //   $pageConfigs = ['pageHeader' => false];
    
  //   return view('.content.dashboard.admin.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  // }
}
