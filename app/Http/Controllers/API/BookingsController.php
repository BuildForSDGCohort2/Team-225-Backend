<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Hotel;
use App\User;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class BookingsController extends Controller
{
    // make a record of a booking in the db
    public function makeBooking(Request $request)
    {
        try {
            $request->validate([
                'check_in_date' => 'required',
                'check_in_time' => 'required',
                'check_out_date' => 'required',
                'check_out_time' => 'required',
                'rooms' => 'required'
            ]);

            $booking = Booking::create([
                'check_in_date' => $request->input('check_in_date'),
                'check_in_time' => $request->input('check_in_time'),
                'check_out_date' => $request->input('check_out_date'),
                'check_out_time' => $request->input('check_out_time'),
                'user_id' => auth()->user()->id,
                'hotel_id' => $request->input('hotel_id'),
                'adults' => $request->input('adults'),
                'children' => $request->input('children'),
                'total_price' => array_sum(collect(json_decode($request->input('rooms'), true))->pluck('total_amount')->toArray()),
                'number_of_rooms' => $request->input('number_of_rooms'),
                'payment_status' => false,
                'rooms' => $request->input('rooms')
            ]);

            return response()->json([
                'success' => true,
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            Log::error('An error occurred while creating a booking' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'failed to make a booking'
                ]
            ], 500);
        }
    }

    public function getABooking($id)
    {
        try {
            $booking = Booking::where('id', $id)->first();
            $hotel = Hotel::find($booking->hotel_id)->first();
            $user = User::find($booking->user_id)->first();
            $rms = json_decode($booking->rooms, true);
            $rooms = Room::find(array_keys($rms))->toArray();

            return response()->json([
                'success' => true,
                'data' => [
                    'booking' => $booking,
                    'hotel' => $hotel,
                    'user' => $user,
                    'rooms' => $rooms,
                    'number_of_rooms' => $rms
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('An error occurred while getting a booking' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => 'failed to retrieve a booking'
                ]
            ], 500);
        }
    }
}
