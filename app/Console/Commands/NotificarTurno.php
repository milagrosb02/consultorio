<?php

namespace App\Console\Commands;

use App\Models\Turno;
use Illuminate\Console\Command;

class NotificarTurno extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paciente:notificate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tiene tiempo de cancelar el turno hasta 48 hs antes. De lo contrario, pierde el turno';

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
        // el turno se cancela hasta 48 hs antes
        $date = now()->subHours(48);

        
    }
}
