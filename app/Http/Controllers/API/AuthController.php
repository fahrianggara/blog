<?php /** @noinspection PhpWrongStringConcatenationInspection */
/** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // return response()->json([
            //     'message' => 'Unauthorized'
            // ], 401);

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $tes = Util::createToken($user);

        $token = $user->createToken('token', ['server:update'])->plainTextToken;

        $user->test = $user->name . " " . $user->email;

        return response()->json([
            'message' => 'Success',
            'data' => $user,
            'token' => $token,
            'test' => $tes,
            'test2' => $a->testAja()
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
