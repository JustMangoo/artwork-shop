<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        Log::info('CONTACT send method:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $responseBody = json_decode($response->getBody());

        if (!$responseBody->success) {
            return redirect()->back()->withErrors(['captcha' => 'reCAPTCHA verification failed']);
        }

        Log::info('CONTACT after validation');

        Mail::send(new ContactFormMail($validatedData));

        return redirect()->back()->with('message', 'Jūsu ziņojums ir veiksmīgi nosūtīts!');
    }
}