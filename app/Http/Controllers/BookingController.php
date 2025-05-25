<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function pilih_jadwal(Request $request)
    {
        $request->validate([
            'booking_date' => 'required',
            'booking_start' => 'required',
            'booking_end' => 'required',
        ], [
            'booking_date.required' => 'Tanggal harus dimasukkan.',
            'booking_start.required' => 'Waktu harus dimasukkan.',
            'booking_end.required' => 'Waktu harus dimasukkan.'
        ]);
    }
}
