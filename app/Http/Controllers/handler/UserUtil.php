<?php


namespace App\Http\Controllers\handler;


use App\Models\User;

class UserUtil
{


    public static function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public static function getUserById($id)
    {
        return User::where('id', $id)->first();
    }
}
