<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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

        try {
            $this->validate($request, [

                'username' => 'required',
                'password' => 'required'

            ]);
        } catch (ValidationException $e) {
            if ($e->getCode()==400){
                return response()->json(
                    ['error'=>'Check your Credentials'],
                    400);
            }
        }

        return $this->issueToken($request,'password');

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
}
