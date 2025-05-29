<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($email_addr)
    {
        $data = [
            'name' => 'John Doe',
            'message' => 'This is a test email from Laravel 12.'
        ];

        Mail::to($email_addr)->send(new SendMail($data));

        return response()->json(['success' => 'Email sent successfully.']);
    }
}
