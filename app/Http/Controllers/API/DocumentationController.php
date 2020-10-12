<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index() {
        return response()->json([
            'success' => true,
            'data' => [
                'docs' => 'https://zurri-booking.herokuapp.com'
            ]
        ]);
    }
}
