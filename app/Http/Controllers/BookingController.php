<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Qris;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function booking(Request $request)
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
    
        $roomDetail = Room::getDetailRoomWIthSchedule($request->room_id);
        $schedule = $roomDetail['schedule'] ?? [];
    
        $selectedDate = $request->booking_date;
        $startInput = $request->booking_start;
        $endInput = $request->booking_end;
    
        $startInput = strtotime($startInput);
        $endInput = strtotime($endInput);
        
        $conflicts = array_filter($schedule, function ($item) use ($selectedDate, $startInput, $endInput) {
            if ($item['booking_date'] !== $selectedDate) {
                return false;
            }
    
            $bookedStart = strtotime($item['booking_start']);
            $bookedEnd = strtotime($item['booking_end']);
    
            return $startInput < $bookedEnd && $endInput > $bookedStart;
        });
    
        if (count($conflicts) > 0) {
            return back()->withErrors([
                'booking_start' => 'Waktu yang Anda pilih bertabrakan dengan jadwal yang sudah ada.',
                'booking_end' => 'Silakan pilih waktu yang lain.'
            ])->withInput();
        }
    
        $step = [true, true, false];
        $bookingData = [
            'customer_fullname' => session('customer')['customer_fullname'],
            'customer_email' => session('customer')['customer_email'],
            'booking_date' => $request->booking_date,
            'booking_start' => $request->booking_start,
            'booking_end' => $request->booking_end,
            'booking_price' => $request->booking_price,
            'booking_price_formated' => $request->booking_price_formated,
            'booking_duration' => $request->booking_duration
        ];
        session(['booking_data' => $bookingData]);

        return redirect()->to('booking-konfirmasi/' . $request->room_id);
    }

    public function booking_konfirmasi(Request $request)
    {
        $request->validate([
            'booking_desc' => 'required|max:350'
        ], [
            'booking_desc.required' => 'Tujuan peminjaman harus diisi.',
            'booking_desc.max' => 'Maksimal 350 karakter',
        ]);

        $bookingData = session('booking_data', []);

        $response = Booking::addBooking([
            'room_id' => $request->room_id,
            'customer_id' => session('customer')['customer_id'],
            'booking_date' => $bookingData['booking_date'],
            'booking_start' => $bookingData['booking_start'],
            'booking_end' => $bookingData['booking_end'],
            'booking_price' => $bookingData['booking_price'],
            'booking_desc' => $request->booking_desc,
        ]);
        
        $bookingResponse = Booking::getDetailBooking($response['data']['booking_id']);
        $bookingData['booking_code'] = $bookingResponse['booking_code'];

        $qrisresponse = Qris::generateQris([
            $bookingResponse['booking_code'],
            $bookingResponse['booking_price'],
        ]);

        Booking::qrisBooking([
            'booking_id' => $bookingResponse['booking_id'],
            'qris_url' => $qrisresponse['___unofficial_data']['url'],
            'qris_content' => $qrisresponse['data']['qris_content'],
            'qris_invoiceid' => $qrisresponse['data']['qris_invoiceid'],
            'qris_nmid' => $qrisresponse['data']['qris_nmid'],
        ]);

        $bookingResponse = Booking::getDetailBooking($response['data']['booking_id']);
        $bookingData['qris_url'] = $bookingResponse['qris_url'];
        $bookingData['qris_content'] = $bookingResponse['qris_content'];
        $bookingData['qris_invoiceid'] = $bookingResponse['qris_invoiceid'];
        $bookingData['qris_nmid'] = $bookingResponse['qris_nmid'];

        return redirect()->to('booking-pembayaran/' . $bookingResponse['booking_code']);
        
    }

    public function paid_off(Request $request)
    {
        $booking = Booking::getDetailBooking($request->booking_id);
        $booked = Room::getDetailRoomWIthSchedule($request->room_id);

        // dd($booking);
        $createdAt = Carbon::parse($booking['created_at']);
        $now = Carbon::now();
        
        if (Carbon::now()->greaterThan(Carbon::parse($booking['created_at'])->addMinutes(5))) {
            return redirect()->to('ruangan/' . $booking['room_id'])
                ->with('error', 'Sesi pembayaran Anda telah habis, silakan lakukan booking ulang.');
        }        

        if (!empty($booked['schedule'])) {
            foreach ($booked['schedule'] as $x) {
                if ($x['booking_id'] !== $booking['booking_id'] && $x['booking_status'] == 1) {
                    if ($x['booking_date'] == $booking['booking_date']) {
                        $startA = strtotime($booking['booking_start']);
                        $endA = strtotime($booking['booking_end']);
                        $startB = strtotime($x['booking_start']);
                        $endB = strtotime($x['booking_end']);

                        if ($startA < $endB && $endA > $startB) {
                            return redirect()->to('ruangan/' . $booking['room_id'])->with('error', 'Waktu peminjaman yang Anda pilih bertabrakan dengan peminjam lain. Silakan pilih waktu lain.');
                        }
                    }
                }
            }
        }

        $response = Booking::paid_off($request->booking_id);

        return redirect()->to('riwayat/' . $response['olddata']['booking_code'])->with('success', 'Anda berhasil membooking ruangan ini.');
    }

}
