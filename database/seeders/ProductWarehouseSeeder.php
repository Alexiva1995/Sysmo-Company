<?php

namespace Database\Seeders;
use App\Models\ProductWarehouse;


use Illuminate\Database\Seeder;

class ProductWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductWarehouse::create([
            'name' => 'Cashbot RS',
            'description' => 'Descripcion de Cashbot RS',
            'price' => '210',
            'photoDB' => 'Cashbot RS_caballo.jpg',
            'status' => '1'
        ]);

        ProductWarehouse::create([
            'name' => 'Cashbot Pro',
            'description' => 'Descripcion de Cashbot PRO',
            'price' => '300',
            'photoDB' => 'Cashbot Pro_osopolar.jpg',
            'status' => '1'
        ]);
    }
}
