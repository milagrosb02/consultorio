<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'first_name' => ['required', 'max:25'],

            'last_name' => ['required', 'max:25'],

            'email' => ['required', 'unique:users', 'email', 'min:10'],

            'password' => ['required', 'min:5', 'confirmed'],

            'password_confirmation' => ['required', 'same:password', 'min:5'],

            'phone' => ['required', 'max: 20'],

            'obra_social_id' => ['required']
        ];

    }


    public function messages()
    {
        return[

            

            'first_name.required' => 'El nombre es obligatorio. ',

            'first_name.max' => 'Nombre demasiado largo. ',

            'last_name.required' => 'El apellido es obligatorio. ',

            'last_name.max' => 'Apellido demasiado largo. ',

            'email.required' => 'El email es obligatorio. ',

            'email.unique' => 'Este email ya está en uso. Ingresa otro. ',

            'email.email' => 'El email debe ser válido. Ingresa otro. ',

            'password.required' => 'La contraseña es obligatoria. ',

            'password.min' => 'La contraseña es muy corta. ',

            'password_confirmation.same' => 'Las contraseñas no coinciden. ',

            'phone.required' => 'El teléfono es obligatorio. ',

            'phone.max' => 'El teléfono no es válido. ',

            'obra_social_id.required' => 'La obra social es obligatoria. '
        ];
    }
}
