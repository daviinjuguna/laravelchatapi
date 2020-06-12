<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RecoverPasswordRequest;
use App\Mail\UserPasswordPin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    //avoid predictable pins
    private $unwantedPins = [
        111111,222222,333333,444444,555555,666666,777777,888888,999999
    ];

    private function inUnWanted($pin)
    {
        return in_array($pin,$this->unwantedPins);
    }

    public function recover(RecoverPasswordRequest $request)
    {

        //check if email exist

        $user = User::where(['email' => $request->email])->first();

        if (is_null($user)){
            return response([
                'errors'=>'The email entered is not registered'
            ],404);
        }

        //send recover password code like six digit code to the recovery email
        $pin = rand( 111111,999999);
        foreach ($this->unwantedPins as $unwantedPin){
            if ($pin == $unwantedPin){
                $pin = rand(111111,999999);
            }
        }
        $user->pin = $pin;//save pin to database
        $user->save();

        Mail::to($user)->queue(new UserPasswordPin($pin));
        return response([
            'pin'=>$pin,
            'message'=>'a six digit code has been sent to your email'
        ],200);
    }

    public function change(ChangePasswordRequest $request)
    {
        // find user by pin
        //change password with the new one
        $user = User::where(['pin' => $request->pin])->first();
        if (is_null($user)){
            return response([
                'errors'=>'The pin entered is incorrect, check your email'
            ],404);
        }
        $user->password = Hash::make($request['password']);
        $user->save();
        return response([
            'success'=>'password reset was successful',
            'message'=>'please login with your new password'
        ],200);

    }

}
