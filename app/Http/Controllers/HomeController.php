<?php

namespace App\Http\Controllers;

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
                'booking_date' => $request->booking_date,
                'booking_start' => $request->booking_start,
                'booking_end' => $request->booking_end,
                'booking_price' => $request->booking_price,
                'booking_price_formated' => $request->booking_price_formated,
                'booking_duration' => $request->booking_duration
            ];
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
}
