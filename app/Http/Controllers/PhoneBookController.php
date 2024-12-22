<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PhoneBookModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PhoneBookController extends Controller
{
    function onInsert(Request $request)
    {

        $token= $request->input('access_token');
        $key=env('TOKEN_KEY');

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;


        $user=$decoded_array['user'];
        $one= $request->input('one');
        $two=$request->input('two');
        $name=$request->input('name');
        $email=$request->input('email');

        $result= PhoneBookModel::insert(['username'=>$user,'phone_number_one'=>$one,
                                        'phone_number_two'=>$two,'name'=>$name,
                                        'email'=>$email ]);


        if($result==true)
        {
            return 'Save successful';
        }

        else
        {
            return 'Fail ! Try Again';
        }
    }

    function onSelect()
    {

    }

    function onDelete()
    {

    }
}
