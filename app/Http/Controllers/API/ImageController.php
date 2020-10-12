<?php

namespace App\Http\Controllers\API;

use App\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function addHotelImages(Request $request, $id) {
        $hotel = Hotel::where('id', $id)->first();

        try {
            if(!$request->hasFile('hotel_image')) {
                return response()->json([
                    'success' => false,
                    'errors' => 'Please provide an image for the hotel'
                ], 400);
            }

            $cloudinary_response = $request->file('hotel_image')->storeOnCloudinary('hotels');

            $image = new Image();
            $image->title = $hotel->hotel_name.'-hotel-cover';
            $image->url = $cloudinary_response->getSecurePath();

            $hotel->images()->save($image);
            $hotel->refresh();

            return response()->json([
                'success' => true,
                'data' => [
                    'hotel' => $hotel,
                    'images' => $hotel->images,
                    'message' => 'Images successfully uploaded'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Upload Error:'. $e->getMessage());

            return response()->json([
                'success' => false,
                'errors' => 'Failed to upload image, its our fault though, please try again'
            ]);
        }

    }
}
