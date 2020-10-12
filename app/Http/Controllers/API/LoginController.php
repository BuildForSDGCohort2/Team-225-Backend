<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request) {
        try {
            $validator = $this->validator($request);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'errors' => $validator->errors()
                    ]
                    ], 400);
            }

            $data = $validator->validated();

            if(Auth::attempt($data)) {
                $user = User::where('email', $data['email'])->first();

                $token = $user->createToken('user-'.$user->id)->accessToken;

                return response()->json([
                    'success' => true,
                    'data' => [
                        'user' => $user,
                        'message' => 'User logged in successfully',
                        'token' => $token
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Invalid Credentials'
                ]
                ], 400);

        } catch (\Exception $e) {
            Log::error('An error occured while trying to authenticate the user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Login failed, please try again'
                ]
            ], 500);
        }
    }

    /**
     * Validate request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(Request $request)
    {
        return FacadesValidator::make($request->only(['email', 'password']), [
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);
    }
}
