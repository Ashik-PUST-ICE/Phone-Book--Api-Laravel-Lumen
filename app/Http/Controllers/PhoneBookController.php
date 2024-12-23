<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\PhoneBookModel;
use App\Http\Controllers\Exceptions;
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

    function onSelect(Request $request)
    {

        $token= $request->input('access_token');
        $key=env('TOKEN_KEY');

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;

        $user=$decoded_array['user'];


        $result= PhoneBookModel::where('username',$user)->get();

        return $result;

    }

    function onDelete(Request $request)

    {
        $email=$request->input('email');
        $token= $request->input('access_token');
        $key=env('TOKEN_KEY');

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;

        $user=$decoded_array['user'];


        $result= PhoneBookModel::where(['username'=>$user,'email'=>$email])->delete();

        if ($result==true)
        {
            return "Delete Success";
        }


        else
        {
            return "Delete Fail !! Try Again";
        }
    }

    function onUpdate(Request $request)
{
    // Token and ID retrieval
    $token = $request->input('access_token');
    $id = $request->input('id');

    // Token or ID missing error
    if (empty($token) || empty($id)) {
        return response()->json(['message' => 'Access token and ID are required'], 400);
    }

    try {
        // Decode token
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array = (array)$decoded;
    } catch (\Exception $e) {
        return response()->json(['message' => 'Invalid token: ' . $e->getMessage()], 401);
    }

    $user = $decoded_array['user'] ?? null;

    // User validation
    if (!$user) {
        return response()->json(['message' => 'Unauthorized: No user found in token'], 401);
    }

    // Find the record
    $record = PhoneBookModel::find($id);

    // Record not found
    if (!$record) {
        return response()->json(['message' => 'Record not found'], 404);
    }

    // Ensure the record belongs to the user
    if ($record->username !== $user) {
        return response()->json(['message' => 'Unauthorized: You cannot update this record'], 403);
    }

    // Update fields if provided
    $record->phone_number_one = $request->input('one', $record->phone_number_one);
    $record->phone_number_two = $request->input('two', $record->phone_number_two);
    $record->name = $request->input('name', $record->name);
    $record->email = $request->input('email', $record->email);

    // Save the updated record
    if ($record->save()) {
        return response()->json(['message' => 'Update successful'], 200);
    } else {
        return response()->json(['message' => 'Update failed'], 500);
    }
}



}
