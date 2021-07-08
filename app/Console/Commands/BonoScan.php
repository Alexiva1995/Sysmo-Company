<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para los bonos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $texto = "Nombre de usuario: Eulin. Fecha y hora de CronJob: " . Carbon::now();
        Storage::append("archivo.txt", $texto);
    }
}
