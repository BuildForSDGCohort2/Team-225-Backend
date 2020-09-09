<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class RegisterController extends Controller
{
    /**
     * Register a user into the application
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request) {
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

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $user->createToken('user-' . $user->id)->accessToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'message' => 'User registered successfully',
                    'token' => $token
                ]
                ], 201);
        } catch (\Exception $e) {
            Log::error('An error occured while trying to register a user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Registration failed, please try again'
                ]
                ], 500);
        }
    }

    /**
     * Validate request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(Request $request) {
        return FacadesValidator::make($request->only(['name', 'email', 'password']), [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);
    }
}
