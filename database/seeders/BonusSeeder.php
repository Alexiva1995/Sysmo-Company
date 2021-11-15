<?php

namespace Database\Seeders;

use App\Models\Bonus;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
           'name' => 'Bono Automático',
           'description' => 'Por cada 10 referidos directos que compren algún paquete, usted ganará 100USD',
           'note' => '',
        ]);
        Bonus::create([
         'name' => 'Bono de arranque',
         'description' => 'Si en los primeros 30 días calendario después del ingreso a SYSMO, tiene como mínimo cuatro (4) referidos, recibirá un bono extra de 50 USD adicional a las comisiones.',
         'note' => ''
      ]);
        Bonus::create([
            'name' => 'Bono de Velocidad',
            'description' => 'Si en los primeros 30 días calendario después del ingreso a SYSMO tiene como mínimo veintidós (22) referidos, se le dará como bono 400 USD adicional a las comisiones.',
            'note' => '',
         ]);
         Bonus::create([
            'name' => 'Bono de Viaje',
            'description' => 'Cuando complete los cincuenta (50) referidos recibirá adicional a las comisiones, un viaje a la Isla de San Andrés, en Colombia, para (1) persona. Si esos cincuenta (50) referidos lo cumple en los primeros noventa (90) días después del ingreso a SYSMO, el viaje aplicara para dos (2) personas',
            'note' => 'Si el usuario se encuentra fuera de Colombia se le podrá hacer efectivo el valor del viaje. (El viaje tendrá 60 días para ser redimido. Aplica términos y condiciones.)',
         ]);
         Bonus::create([
            'name' => 'Bono de Moto',
            'description' => 'Cuando sume cien (100) referidos recibirá una moto cero (0) kilómetros, adicional a las comisiones.',
            'note' => 'La moto será entregada en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones',
         ]);
         Bonus::create([
            'name' => 'Bono de Carro',
            'description' =>  'Cuando sume quinientos (500) referidos recibirá un carro cero (0) kilómetros, adicional a las comisiones.',
            'note' => 'El carro será entregado en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones',
         ]);
         // Bonus::create([
         //    'name' => 'Direct Bonus',
         //    'description' => 'El bono directo será cada paquete RS pagará 50USD y cada PRO pagara 70USD',
         //    'note' => 'Los planes tendran vigencia durante 12 meses',
         // ]);
         
         
    }
}
