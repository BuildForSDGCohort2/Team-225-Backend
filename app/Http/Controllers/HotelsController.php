<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;

class HotelsController extends Controller
{
    //
    public function getAllHotels()
    {
         $hotels = Hotel::get()->toJson(JSON_PRETTY_PRINT);
        return response($hotels, 200);
    }

    public function getHotel($id)
    {
        if (Hotel::where('id', $id)->exists()) {
        $hotel = Hotel::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($hotel, 200);
      } else {
        return response()->json([
          "message" => "hotel not found"
        ], 404);
      }
    }


    public function createHotel(Request $request)
    {
        //validate new hotel
         $request->validate([
           'hotel_name'=>'required',
                'description'=>'required',
                'price'=>'required|numeric'  
            ]);
         $formdata = array(
            'hotel_name'=>$request->hotel_name,
            'description'=>$request->description,
            'price'=>$request->price
            );
         if (Hotel::create($formdata)) {
              return response()->json([
            "message" => "Hotel created"
        ], 200);
         }
         

    }

    public function updateHotel(Request $request, $id)
    {
        //
        $hotel= Hotel::whereid($id)->firstOrFail();

        $request->validate([
            'hotel_name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric' 
        ]);

        $hotel->hotel_name = $request->get('hotel_name');
        $hotel->description = $request->get('description');
        $hotel->price = $request->get('price');
        $hotel->save();


          return response()->json([
            "message" => "hotel updated successfully"
        ], 200);

    }
    public function deleteHotel(Request $request, $id)
    {
         $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return response()->json([
            "message" => "hotel deleted"
        ], 204);
    }
    

}
