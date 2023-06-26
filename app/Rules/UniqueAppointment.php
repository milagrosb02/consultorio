<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Turno;

class UniqueAppointment implements Rule
{

    protected $fecha;
    protected $hora;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($fecha, $hora)
    {
        $this->fecha = $fecha;

        $this->hora = $hora;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Verificar si ya existe un turno con la misma fecha y hora
        return !Turno::where('fecha', $this->fecha)
            ->where('hora', $this->hora)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puedes acceder a este horario o fecha de turno porque ya está ocupado.';
    }
}
