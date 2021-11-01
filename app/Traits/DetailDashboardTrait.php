<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\User;

trait DetailDashboardTrait{

    /**
     * Permite obtener el total de usuarios disponibles
     *
     * @return void
     */
    public function getTotalUser()
    {
        return User::count('id');
    }

    /**
     * Permite obtener el total de las ordenes
     *
     * @return void
     */
    public function getTotalOrder()
    {
        return Order::count('id');
    }

    /**
     * Permite obtener el monto total de todas las compras en el sistema
     *
     * @return void
     */
    public function getTotalMountOrder()
    {
        return Order::sum('amount');
    }

    /**
     * Permite obtener los datos para la grafica de ordenes
     *
     * @return array
     */
    public function getdateGraphiOrdensMonth(): array
    {
        $ordenesMonth = Order::whereRaw('year(created_at) = YEAR(now())')
                                ->groupByRaw('MONTH(created_at)')
                                ->selectRaw('COUNT(id) as total, MONTH(created_at) as mes')
                                ->get();
        
        $dataArray = [];

        for ($i=0; $i < 12; $i++) { 
            $dataArray[$i] = 0;
            foreach ($ordenesMonth as $orden) {
                if ($orden->mes == ($i+1) && $orden->total > 0) {
                    $dataArray[$i] = $orden->total;
                }
            }
            
        }
        return $dataArray;
    }

    /**
     * Permite obtener un listado con las ultimas 10 ordenes
     *
     * @return void
     */
    public function getOrdensList()
    {
        $ordenes = Order::orderBy('id', 'desc')->take(10)->get();

        foreach ($ordenes as $orden) {
            $orden->name_user = $orden->getUser->fullname();
            $orden->estado = 'En Espera';
            if ($orden->status == 1) {
                $orden->estado = 'Completado';
            }
            if ($orden->status == 2) {
                $orden->estado = 'Cancelado';
            }
        }
        return $ordenes;
    }
}
