<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use IssueTokenTrait;
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
                'email' => 'required',
                'password' => 'required'

            ]);
        $authAttempt = Auth::attempt($credentials);
        if (!$authAttempt){
            return response([
                'error'=>'forbidden',
                'message'=>'Check your Credentials'
            ],403);
        }else{
            return $this->issueToken($request,'password');

        }

    }

    public function logout( Request $request)
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update(['revoked'=>true]);

        $accessToken->revoke();
        return response()->json('Logged Out Successfully',204);
    }

    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'

        ]);
        return $this->issueToken($request,'refresh_token');

    }
}
