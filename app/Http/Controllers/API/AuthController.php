<?php /** @noinspection PhpWrongStringConcatenationInspection */
/** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\handler\UserUtil;
use App\Http\Controllers\handler\Util;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login dengan API
    public function login(Request $request)
    {
        $user = User::getUserByEmail($request->email);

        if (User::checkUserPassword($user, $request)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

            /*throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);*/
        }

        $token = User::createNewToken($user);

        return response()->json([
            'message' => 'Success',
            'data' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'berhasil logout!'
        ]);
    }
}
