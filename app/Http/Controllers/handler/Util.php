<?php

namespace App\Http\Controllers\handler;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Util
{

    public $a = 0;

    public static function createToken(User $user)
    {
        return $user->createToken('token', ['server:update'])->plainTextToken;
    }

    public function checkPassword(User $user, Request $request)
    {
        return (!$user || !Hash::check($request->password, $user->password));
    }

    public function testAja()
    {
        return "test aja";
    }

    public function setData($newdata)
    {
        $this->a = $newdata;
    }

    public function getData(){
        return $this->a;
    }
}
