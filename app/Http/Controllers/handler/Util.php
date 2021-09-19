<?php


namespace App\Http\Controllers\handler;

use App\Models\User;

class Util
{
    public static function createToken(User $user)
    {
        return $user->createToken('token', ['server:update'])->plainTextToken;
    }

    public function testAja()
    {
        return 2;
    }
}
