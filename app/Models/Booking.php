<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Booking extends Model
{
    public static function getDetailBooking($booking_id)
    {
        $response = Http::get(env('API_SERVER') . 'booking/detail/' . $booking_id, [
            'access_token' => env('API_ACCESS_TOKEN'),
        ]);

        return $response->json();
    }
    public static function addBooking($bookingData)
    {
        $response = Http::post(env('API_SERVER') . 'booking/add', [
            'access_token' => env('API_ACCESS_TOKEN'),
            'room_id' => $bookingData['room_id'],
            'customer_id' => $bookingData['customer_id'],
            'booking_date' => $bookingData['booking_date'],
            'booking_start' => $bookingData['booking_start'],
            'booking_end' => $bookingData['booking_end'],
            'booking_price' => $bookingData['booking_price'],
            'booking_desc' => $bookingData['booking_desc'],
            'booking_status' => 0,
        ]);

        return $response->json();
    }
}
