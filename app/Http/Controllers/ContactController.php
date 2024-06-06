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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Log::info('CONTACT after validation');

        Mail::send(new ContactFormMail($validatedData));

        return redirect()->back()->with('message', 'Jūsu ziņojums ir veiksmīgi nosūtīts!');
    }
}
