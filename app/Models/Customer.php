<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Customer extends Model
{
	public static function addCustomer($customerData)
	{
		$response = Http::post(env('API_SERVER') . 'customer/add', [
			'access_token' => env('API_ACCESS_TOKEN'),
			'customer_fullname' => $customerData['customer_fullname'],
			'customer_email' => $customerData['customer_email'],
			'customer_pass' => $customerData['customer_pass'],
			'google_id' => isset($customerData['google_id']) ? $customerData['google_id'] : null,
		]);

		return $response->json();
	}

	public static function login_google($google_id)
	{
		$response = Http::post(env('API_SERVER') . 'login/user-google', [
			'access_token' => env('API_ACCESS_TOKEN'),
			'google_id' => $google_id,
		]);

		return $response->json();
	} 

	public static function getCustomerByEmailNormal($customer_email)
	{
		$response = Http::post(env('API_SERVER') . 'customer/detail/email-normal', [
			'access_token' => env('API_ACCESS_TOKEN'),
			'customer_email' => $customer_email,
		]);

		return $response->json();
	}
}
