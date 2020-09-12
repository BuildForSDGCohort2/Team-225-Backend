<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Room;
use App\Hotel;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    //
    public function getAllRooms()
    {
       try {
        $rooms = Room::all();
        return response()->json([
            'success'=> true,
            'data'=>[
                'rooms'=>$rooms,
                'count'=>$rooms->count()
            ]
        ]);
           
       } catch (\Exception $e) {
           Log::error('An error occured while loading items'.$e->getMessage());
           return response()->json([
            'success'=>false,
            'data'=>[
                'errors'=>'Failed to load rooms'
            ]
           ]);
       }
    }

    public function addHotelsRooms(Request $request, $id)
    {
    	try {
    		 $hotel = Hotel::findOrFail($id);
    	 	 $validatedData = $this->validator($request);
    	 	if ($validatedData->fails()) {
                    return response()->json([
                        'success' => false,
                        'data' => [
                            'message' => 'failed to add room',
                            'errors' => $validatedData->errors()
                        ]
                        ], 400);
    		      }
    			$room = new Room();
    			$room->hotel_id = $hotel->id;
    			$room->name = $request->get('name');
    			$room->description = $request->get('description');
    			$room->price = $request->get('price');
    			$room->minimum_stay_night = $request->get('minimum_stay_night');
    			$room->max_number_of_guests = $request->get('max_number_of_guests');
    			$room->save();
    	return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'room added successfully',
                    'room' => $room,
                ]
            ]);
    		
    	} catch (\Exception $e) {
    		 Log::error('An error occured while adding a room: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'data' => [
                        'errors' => 'Failed to add room, please try again'
                    ]
                    ], 500);
    	}
	
    	
	}
    public function updateRoom(Request $request, $id)
    {
            try {
                $hotel = Hotel::whereid($id)->firstOrFail();
                $validatedData = $this->validator($request);
                if ($validatedData->fails()) {
                   return response()->json([
                    'success'=>false,
                    'data'=>[
                        'message'=>'Failed to update room',
                        'errors'=>$validatedData->errors()
                    ]
                   ]);
                }
                    $room = new Room();
                    $room->hotel_id = $hotel->id;
                    $room->name = $request->get('name');
                    $room->description = $request->get('description');
                    $room->price = $request->get('price');
                    $room->minimum_stay_night = $request->get('minimum_stay_night');
                    $room->max_number_of_guests = $request->get('max_number_of_guests');
                    $room->save();
                    return response()->json([
                    'success' => true,
                    'data' => [
                        'message' => 'Room updated successfully',
                        'room' => $room,
                        ]
                    ]);
            
                
            } catch (\Exception $e) {
                Log::error('Failed to update Room'.$e->getMessage());
                return response()->json([
                    'message'=>false,
                    'data'=>[
                        'error'=>'An error occured while updating room'
                    ]
                ]);
            
        }
    }

    public function getRoom($id)
    {
        try {
            $room = Room::whereid($id)->firstOrFail();
            if ($room) {
                return response()->json([
                      'success' => true,
                       'data' => $room
                ]); 
            }
             return response()->json([
                      'success' => false,
                       'data' =>[
                        'errors'=>'Hotel not found'
                       ]
                ]); 
            
        } catch (\Exception $e) {
            Log::error('An error occured while loading Room'.$e->getMessage());
              return response()->json([
                'success'=>false,
                'data'=>[
                    'errors' => 'Room not found'
                ]
            ], 500);
        }
    }
    public function deleteRoom($id)
    {
        try {
             $room = Room::findOrFail($id);
             $room->delete();
             return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'room successfully deleted',
                    'hotel' => $room
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('An error occured while deleting room' .$e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'Deleting room failed please try again'
                ]
            ], 500);
        }
         
       
    }

	private function validator(Request $request) {

        return Validator::make($request->only(['name', 'description', 'price']), [
        	'name'=>'required',
        	'description'=> 'required',
        	'price'=>'required'
        ]);   
    }
}