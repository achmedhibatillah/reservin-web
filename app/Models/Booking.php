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

    public static function getDetailBookingByCode($booking_code)
    {
        $response = Http::post(env('API_SERVER') . 'booking/detail-code', [
            'access_token' => env('API_ACCESS_TOKEN'),
            'booking_code' => $booking_code,
        ]);

        return $response->json();
    }

    public static function addBooking($bookingData = [])
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

    public static function qrisBooking($bookingData)
    {
        $response = Http::put(env('API_SERVER') . 'booking/update', [
            'access_token' => env('API_ACCESS_TOKEN'),
            'booking_id' => $bookingData['booking_id'],
            'qris_url' => $bookingData['qris_url'],
            'qris_content' => $bookingData['qris_content'],
            'qris_invoiceid' => $bookingData['qris_invoiceid'],
            'qris_nmid' => $bookingData['qris_nmid']
        ]);

        return $response->json();
    }

    public static function paid_off($booking_id)
    {
        $response = Http::put(env('API_SERVER') . 'booking/update', [
            'access_token' => env('API_ACCESS_TOKEN'),
            'booking_id' => $booking_id,
            'booking_status' => 1
        ]);

        return $response->json();
    }

    public static function getBookingByCode($booking_code)
    {
        $response = Http::post(env('API_SERVER') . 'booking/detail-code', [
            'access_token' => env('API_ACCESS_TOKEN'),
            'booking_code' => $booking_code,
        ]);

        return $response->json();
    }
}
