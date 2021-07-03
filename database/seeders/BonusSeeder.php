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
           'name' => 'Money Bonus',
           'description' => 'Por cada 10 referidos directos que compren algún paquete, usted ganará 100USD',
           'note' => '',
           'recurrent' => '1'
        ]);
        Bonus::create([
            'name' => 'Speed Bonus',
            'description' => 'Si en los primeros 30 días después de su ingreso tiene 20 referidos, se le dará como bono el retorno del 100% de los próximos 2 referidos',
            'note' => 'Para aplicar a este bono debe tener esos 2 referidos en los siguientes 15 días',
            'recurrent' => '0'
         ]);
         Bonus::create([
            'name' => 'Start Bonus',
            'description' => 'Si obtiene 3 referidos en los primeros 15 días de su ingreso a SYSMO, recibirá por su 4 referido un bono extra de 50USD',
            'note' => 'Para aplicar a esta comisión extra, el referido #4 debe traerlo durante los primeros 30 días',
            'recurrent' => '0'
         ]);
         Bonus::create([
            'name' => 'Direct Bonus',
            'description' => 'El bono directo será cada paquete RS pagará 50USD y cada PRO pagara 70USD',
            'note' => 'Los planes tendran vigencia durante 12 meses',
            'recurrent' => '1'
         ]);
         Bonus::create([
            'name' => 'Travel Bonus',
            'description' => 'Cuando complete los 50 referidos recibirá adicional, un viaje a San Andrés para 1 persona todo incluido, si esos 50 referidos los cumple en los primeros 90 días de su ingreso a SYSMO, el viaje aplicará para 2 personas todo incluido.',
            'note' => 'Si el usuario se encuentra fuera de Colombia se le podrá hacer efectivo el valor del viaje. (El viaje tendrá 60 días para ser redimido. Aplica términos y condiciones.)',
            'recurrent' => '0'
         ]);
         Bonus::create([
            'name' => 'Motorbike Bonus',
            'description' => 'Al sumar 100 referidos, usted recibirá una moto 0 kilómetros.',
            'note' => 'La moto será entregada en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones',
            'recurrent' => '0'
         ]);
         Bonus::create([
            'name' => 'Car Life Style Bonus',
            'description' => 'Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. ',
            'note' => 'El carro será entregado en los siguientes 60 días después de cumplir con el requisito. Aplica términos y condiciones',
            'recurrent' => '0'
         ]);
    }
}
