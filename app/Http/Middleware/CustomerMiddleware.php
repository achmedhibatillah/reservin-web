<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('is_user') !== true) {
            $request->session()->put('page_redirect', $request->fullUrl());
            return redirect('login')->with('warning', 'You must be logged in.');
        }

        $response = Http::post(env('API_SERVER') . 'customer/detail/email-all', [
			'access_token' => env('API_ACCESS_TOKEN'),
			'customer_email' => session()->get('customer')['customer_email'],
		]);

        $response = $response->json();

        if ($response['status'] === 'error') {
            $request->session()->put('page_redirect', $request->fullUrl());
            return redirect('login')->with('warning', 'User not found.');
        }

        return $next($request);
    }
}
