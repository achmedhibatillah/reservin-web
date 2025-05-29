<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateController extends Controller
{
    public static function generateUniqueId(string $table, string $column, int $length = 35): string
    {
        do {
            $randomString = Str::random($length);
            $exists = DB::table($table)->where($column, $randomString)->exists();
        } while ($exists);

        return $randomString;
    }

    public static function generateUniqueNumber(string $table, string $column, int $length = 35): string
    {
        do {
            $randomNumber = str_pad(rand(1, 9) . str_pad(rand(0, 999999999), $length - 1, '0', STR_PAD_LEFT), $length, '0', STR_PAD_LEFT);
            $exists = DB::table($table)->where($column, $randomNumber)->exists();
        } while ($exists);

        return $randomNumber;
    }
}
