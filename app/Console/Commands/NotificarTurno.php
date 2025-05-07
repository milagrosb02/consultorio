<?php

namespace App\Console\Commands;

use App\Models\Turno;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use App\Notifications\RecordatorioDeTurnoNotification;
use Illuminate\Support\Facades\DB;

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
       

         $date = now()->addDays(4);


         // NOTIFICACION
         // filtro del turno
         $pacientes = User::join('pacientes', 'users.id', '=', 'pacientes.user_id')
                ->join('turnos', 'pacientes.id', '=' , 'turnos.paciente_id')
                ->select('first_name AS nombre', 'last_name AS apellido', 'email', 'phone AS telefono', 'fecha')
                ->whereDate('fecha', '=', $date)
                ->get();
                

        // cambiar first por get para poder recorrer el listado de los turnos
         $turno = Turno::whereDate('fecha', '=', $date)->first();
         $turno->load('user','paciente');
         Notification::send($pacientes, new RecordatorioDeTurnoNotification($turno));
 
 

        
    }
}
