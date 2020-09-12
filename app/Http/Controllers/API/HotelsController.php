<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Hotel;
use Illuminate\Support\Facades\Validator;

class HotelsController extends Controller
{
    //get all hotels
    public function getAllHotels()
    {
        try {

             $hotels = Hotel::all();

             return response()->json([
                'success' => true,
                'data' => [
                    'hotels' => $hotels,
                    'count' => $hotels->count()
                ]
             ]);

        } catch (\Exception $e) {
            Log::error('An error occurred while loading hotels' .$e->getMessage());
            return response()->json([
                'success'=>false,
                'data'=>[
                    'errors'=>'Failed to load hotels, try again'
                ]
            ], 500);
        }
    }

    //get a single hotel
    public function getHotel($hotelid)
    {

      try {
          $hotel = Hotel::whereid($hotelid)->firstOrFail();

          if($hotel) {
                return response()->json([
                    'success' => true,
                    'data' => $hotel
                ]);
          }

            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Hotel not found'
                ]
            ]);

      } catch (\Exception $e) {
          Log::error('An error occurred while loading hotel'. $e->getMessage());
          return response()->json([
                'success'=>false,
                'data'=>[
                    'errors' => 'Hotel not found'
                ]
            ], 500);
      }

    }

    //create a new hotel
    public function createHotel(Request $request)
    {
       try {
           $validatedData = $this->validator($request);

         if ($validatedData->fails()) {

            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'failed to create hotel',
                    'errors' => $validatedData->errors()
                ]
                ], 400);
         };

         $formdata = $validatedData->validated();

        $hotel = Hotel::create($formdata);

        return response()->json([
            'success' => true,
            'data' => [
                'message' => 'hotel created successfully',
                'hotel' => $hotel,
            ]
        ]);

       } catch (\Exception $e) {
           Log::error('An error occurred while creating hotel'.$e->getMessage());
           return response()->json([
                'success' => false,
                'data' => [
                    'errors'=>'Creating hotel failed please try again'
                ]
            ], 500);
       }
        
    }

    //update hotel
    public function updateHotel(Request $request, $hotelid)
    {
     
        try {
            $hotel = Hotel::whereid($hotelid)->firstOrFail();
            $validatedData = $this->validator($request);

            if ($validatedData->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'message' => 'failed to update hotel',
                        'errors' => $validatedData->errors()
                    ]
                    ], 400);
            }

            $hotel->hotel_name = $request->get('hotel_name');
            $hotel->description = $request->get('description');
            $hotel->average_price = $request->get('average_price');
            $hotel->address = $request->get('address');
            $hotel->email = $request->get('email');
            $hotel->district = $request->get('district');
            $hotel->contact = $request->get('contact');
            $hotel->save();

            return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'hotel updated successfully',
                    'hotel' => $hotel
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('An error occured while updating hotel'. $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Updating hotel failed please try again'
                ]
            ], 500);
        }

    }
    //delete hotel
    public function deleteHotel($hotelid)
    {
        try {
             $hotel = Hotel::findOrFail($hotelid);
             $hotel->delete();
             return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'hotel successfully deleted',
                    'hotel' => $hotel
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('An error occured while deleting hotel' .$e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Deleting hotel failed please try again'
                ]
            ], 500);
        }
         
    }

    private function validator(Request $request) {

    
        return Validator::make($request->only(['hotel_name', 'description', 'average_price', 'address', 'district', 'contact', 'email']), [

            'hotel_name' => 'required',
            'description' => 'required',
            'average_price' => 'required|numeric',
            'email' => 'email',
            'district' => 'required',
            'address' => 'required',
            'contact' => 'min:10',
        ]);

    }
}
