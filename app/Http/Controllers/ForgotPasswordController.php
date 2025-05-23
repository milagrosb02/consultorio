<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException; // Importa la clase desde el namespace correcto
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    public function passwordAction(Request $request)
    {
        $request->validate([
            'email' => 'nullable',
            'token' => 'required_with:password,password_confirmation'
        ]);

        if ($request->has('token')) {
            // Si se proporciona el token, entonces es una solicitud para restablecer la contraseña
            return $this->resetPassword($request);
        } else {
            // Si no hay token, entonces es una solicitud para olvidar la contraseña
            return $this->sendResetLink($request);
        }
    }

    private function sendResetLink(Request $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    private function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
            // 'password_confirmation' no es necesario porque 'confirmed' ya lo compara automáticamente
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'La contraseña ha sido correctamente actualizada!'
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);
    }

}
