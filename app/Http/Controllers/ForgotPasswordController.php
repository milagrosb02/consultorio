<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;


class ForgotPasswordController extends Controller
{
    

    public function forgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email'
        ]);


        $status = Password::sendResetLink(
            $request->only('email')
        );


        if($status == Password::RESET_LINK_SENT)
        {
            return [

                'status' => __($status)
            ];
        }


        throw ValidationException::withMessages([
            'email'=> [trans($status)],
        ]);

    }


     public function reset(Request $request)
     {

        // estos datos vienen del front
         $request->validate([
             'token'=> 'required',
             'email'=> 'required|email',
             'password' => 'required', 'confirmed'
         ]);


         $status = Password::reset
        (
             $request->only('email', 'password', 'password_confirmation', 'token'),

             function ($user) use ($request)
            {

                $user->forceFill([

                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();


                event(new PasswordReset($user));

            }
        );


        if($status == Password::PASSWORD_RESET)
        {
            return response([

                'message' => 'Password reset succesfully'

            ]);
        }


        return response([

            'message' => __($status)

        ], 500);



     }



}
