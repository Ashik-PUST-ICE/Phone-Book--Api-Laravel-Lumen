<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController extends Controller
{
    function onLogin(Request $request)
    {

       $username=$request->input('username');
       $password=$request->input('password');
       $userCount=RegistrationModel::where(['username'=>$username,'password'=>$password])->count();

       if($userCount==1)
       {
           $key = env('TOKEN_KEY');

           $payload = [
            'site' => 'http://demo.com',
            'user' => $username,
            'iat' => time(),
            'exp' => time()+3600


        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return response()->json(['Token'=>$jwt,'status'=>'Login Success']);
       }

       else
       {
        return "Worng User Name Or Password";
       }
    }
}
