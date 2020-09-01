<?php

namespace App\Http\Controllers;

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

             $hotels = Hotel::All();
             return response()->json([
                'success'=>true,
                'data'=>$hotels
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
          return response()->json([
            'success'=>true,
            'data'=>$hotel
          ]);
      } catch (\Exception $e) {
          Log::error('An error occurred while loading hotel'. $e->getMessage());
          return response()->json([
                'success'=>false,
                'data'=>[
                    'errors'=>'Displaying hotel failed please try again'
                ]
            ], 500);
      }

    }

    //create a new hotel
    public function createHotel(Request $request)
    {
       try {
                //validate new hotel
         $validatedData = Validator::make($request->all(), [
             'hotel_name'=>'required',
              'description'=>'required',
              'price'=>'required|numeric' 
         ]);
         if ($validatedData->fails()) {

            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'failed to create hotel',
                    'errors'=>$validatedData->errors()
                ]
            ]);
         };
         $formdata = array(
            'hotel_name' => $request->hotel_name,
            'description' => $request->description,
            'price'=>$request->price
            );

        Hotel::create($formdata);
        return response()->json([
            'success'=>true,
            'data'=>[
                'message'=>'hotel created successfully',
                'hotel'=>$formdata,
            ]
        ]);
       } catch (\Exception $e) {
           Log::error('An error occurred while creating hotel'.$e->getMessage());
           return response()->json([
                'success'=>false,
                'data'=>[
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
            $validatedData = Validator::make($request->all(), [
                'hotel_name'=>'required',
                'description'=>'required',
                'price'=>'required|numeric' 
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'success'=>false,
                    'data'=>[
                        'message'=>'failed to update hotel',
                       'errors'=>$validatedData->errors()
                    ]
                ]);
            }
            $hotel->hotel_name = $request->get('hotel_name');
            $hotel->description = $request->get('description');
            $hotel->price = $request->get('price');
            $hotel->save();
            return response()->json([
                'success'=>true,
                'data'=>[
                    'message'=>'hotel updated successfully',
                    'hotel'=>$hotel
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('An error occured while updating hotel'. $e->getMessage());
            return response()->json([
                'success'=>false,
                'data'=>[
                    'errors'=>'Updating hotel failed please try again'
                ]
            ], 500);
        }

    }
    //delete hotel
    public function deleteHotel(Request $request, $hotelid)
    {
        try {
             $hotel = Hotel::findOrFail($hotelid);
             $hotel->delete();
             return response()->json([
                'success'=>true,
                'data'=>[
                    'message'=>'hotel successfully deleted',
                    'hotel'=>$hotel
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('An error occured while deleting hotel' .$e->getMessage());
            return response()->json([
                'success'=>false,
                'data'=>[
                    'errors'=>'Deleting hotel failed please try again'
                ]
            ], 500);
        }
         
    }
 
    

}
