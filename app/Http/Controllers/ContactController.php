<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {

        Log::info('CONTACT send method:', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Log::info('CONTACT after validation');

        Mail::send(new ContactFormMail($validated));

        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }
}
