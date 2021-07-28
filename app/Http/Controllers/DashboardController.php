<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

  public function index()
   { 
    $total = Wallet::where('user_id', '=', Auth::id())
    ->where('bonus_id', '!=', 0)
    ->where('type_transaction', '=', 0)
    ->where('liquidated', '=', 0)
    ->where('status', 0)
    ->sum('amount');

     return view('dashboard')->with('total', $total);
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
