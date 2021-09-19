<?php /** @noinspection PhpWrongStringConcatenationInspection */
/** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\handler\UserUtil;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\handler\Util;

class AuthController extends Controller
{
    // Login dengan API
    public function login(Request $request)
    {
        $a = new Util();

        $a->setData(100);

        $user = UserUtil::getUserByEmail($request->email);

        $check = $a->checkPassword($user, $request);

        if ($check) {
            return response()->json([
                'message' => 'Unauthorized',
                'check' => $check
            ], 401);

            /*throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);*/
        }

        $tes = Util::createToken($user);

        $token = "";

        $user->test = $user->name . " " . $user->email;

        $user->tetssss = $a->getData();

        $a->setData(50);

        return response()->json([
            'message' => 'Success',
            'data' => $user,
            'token' => $token,
            'test' => $tes,
            'test2' => $a->testAja(),
            'check' => $check,
            'dataaaa' => $a->getData()
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
