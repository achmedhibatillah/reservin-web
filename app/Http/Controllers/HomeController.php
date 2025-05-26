<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $roomSlide = Room::getAllRoom(10);

        return 
        view('templates/header') . 
        view('templates/navbar') . 
        view('home/index', [
            'roomslide' => $roomSlide
        ]) . 
        view('templates/footbar') . 
        view('templates/footer');
    }

    public function ruangan(Request $request)
    {
        $page = $request->get('page', 1);
        $roomData = Room::getPageRoom(5, $page);
        $k = '';

        if ($request->has('k')) {
            $roomData = Room::searchRoomByName($k, 5);
            $k = $request->k;
        }
    
        return 
            view('templates/header') . 
            view('templates/navbar') . 
            view('home/ruangan', [
                'k' => $k,
                'room' => $roomData
            ]) . 
            view('templates/footbar') . 
            view('templates/footer');
    }

    public function ruangan_detail($room_id)
    {
        $roomData = Room::getDetailRoom($room_id);
    
        return 
            view('templates/header') . 
            view('templates/navbar') . 
            view('home/ruangan-detail', [
                'room' => $roomData
            ]) . 
            view('templates/footbar') . 
            view('templates/footer');
    }

    public function ruangan_booking($room_id, Request $request)
    {
        $roomData = Room::getDetailRoomWIthSchedule($room_id);
        $step = [true, false, false];
        $bookingData =[];
    
        if ($request->has('step-1')) {
            $request->validate([
                'booking_date' => 'required',
                'booking_start' => 'required',
                'booking_end' => 'required',
            ], [
                'booking_date.required' => 'Tanggal harus dimasukkan.',
                'booking_start.required' => 'Waktu harus dimasukkan.',
                'booking_end.required' => 'Waktu harus dimasukkan.'
            ]);
        
            $roomDetail = Room::getDetailRoomWIthSchedule($room_id);
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
        }

        if ($request->has('step-2')) {
            $bookingData = session('booking_data', []);
            $response = Booking::addBooking([
                'room_id' => $roomData['room_id'],
                'customer_id' => session('customer')['customer_id'],
                'booking_date' => $bookingData['booking_date'],
                'booking_start' => $bookingData['booking_start'],
                'booking_end' => $bookingData['booking_end'],
                'booking_price' => $bookingData['booking_price'],
                'booking_desc' => $request->booking_desc,
            ]);
            
            $bookingResponse = Booking::getDetailBooking($response['data']['booking_id']);
            $bookingData['booking_code'] = $bookingResponse['booking_code'];
            $step = [true, true, true];
        }

        if ($request->has('step-3')) {
            $stepview = 'stepcompleted';
        }
        
        if ($step === [true, false, false]) {
            $stepview = 'step1';
        } else if ($step === [true, true, false]) {
            $stepview = 'step2';
        } else if ($step === [true, true, true]) {
            $stepview = 'step3';
        }

        return 
            view('templates/header') . 
            view('templates/navbar') . 
            view('home/ruangan-booking', [
                'room' => $roomData,
                'step' => $step,
                'stepview' => $stepview,
                'booking' => $bookingData,
            ]) . 
            view('templates/footbar') . 
            view('templates/footer');
    }

    public function check()
    {
        $qrisContent = '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';
        return view('home/check', compact('qrisContent'));
    }
}
