<?php

namespace App\Models;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class Room
{
    public static function getAllRoom($top)
    {
        $response = Http::get(env('API_SERVER') . 'room/all', [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);

        if ($response->successful()) {
            $data = collect($response->json());
            return $data->shuffle()->take($top)->values()->all();
        }

        return [];
    }
    
    public static function getPageRoom($perPage = 4, $currentPage = 1)
    {
        $response = Http::get(env('API_SERVER') . 'room/all', [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);
    
        if ($response->successful()) {
            $data = collect($response->json())->values();
    
            $offset = ($currentPage - 1) * $perPage;
            $pagedItems = $data->slice($offset, $perPage)->values();
    
            return new LengthAwarePaginator(
                $pagedItems,
                $data->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
    
        return new LengthAwarePaginator([], 0, $perPage, $currentPage);
    }

    public static function searchRoomByName($k, $perPage = 4, $currentPage = 1)
    {
        $response = Http::get(env('API_SERVER') . 'room/all', [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);
    
        if ($response->successful()) {
            $data = collect($response->json())->values();
    
            $filtered = $data->filter(function ($room) use ($k) {
                return stripos($room['room_name'], $k) !== false;
            })->values();
    
            $offset = ($currentPage - 1) * $perPage;
            $pagedItems = $filtered->slice($offset, $perPage)->values();
    
            return new LengthAwarePaginator(
                $pagedItems,
                $filtered->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
    
        return new LengthAwarePaginator([], 0, $perPage, $currentPage);
    }

    public static function getDetailRoom($room_id)
    {
        $response = Http::get(env('API_SERVER') . 'room/detail/' . $room_id, [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);

        $data = $response->json();

        return $data;
    }

    public static function getDetailRoomWIthSchedule($room_id)
    {
        $response = Http::get(env('API_SERVER') . 'room/detail-schedule/' . $room_id, [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);

        $data = $response->json();

        return $data;
    }
}
