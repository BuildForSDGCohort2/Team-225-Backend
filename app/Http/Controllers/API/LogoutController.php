<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogoutController extends Controller
{
    public function logout(Request $request) {
        try {
            // revoke the user token
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'User logged out successfully'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('An error occured while trying to logout a user' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Logout failed, please try again'
                ]
            ], 500);
        }
    }
}
