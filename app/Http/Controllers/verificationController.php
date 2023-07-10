<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Auth;

class verificationController extends Controller
{
    public function index(){

        $code = Auth::user()->code;
        $accessToken = 'your_access_token';
        $phoneNumber = Auth::user()->phone; 
        $message = 'Le code de confirmation est : ' . $code;

        $response = Http::post('https://dzwilio.com/messages.php', [
            'access_token' => $accessToken,
            'phone_number' => $phoneNumber,
            'message' => $message,
            'auth' => 'auth',
            'return_success' => 'http://typeyourDomain.com/success.php',
            'return_fail1' => 'http://typeyourDomain.com/fail1',
            'return_fail2' => 'http://typeyourDomain.com/fail2.php',
            'return_fail3' => 'http://typeyourDomain.com/fail3.php',
        ]);

        if ($response->successful()) {
            // Request was successful, handle the response
            $data = $response->json(); // Assuming the response is in JSON format
            // Process the data returned by the API
        } else {
            // Request failed, handle the error
            $statusCode = $response->status();
            // Handle the error based on the status code
        }

        return view('auth.confirmPhone');

    }
}
