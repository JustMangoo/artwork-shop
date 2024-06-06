<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscription;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create($validatedData);
        Mail::to($validatedData['email'])->send(new NewsletterSubscription($validatedData));


        return redirect()->back()->with('success', 'Abonēšana ir veiksmīga.');
    }

    public function unsubscribe($email)
    {
        $subscription = Subscription::where('email', $email)->firstOrFail();
        $subscription->delete();

        return redirect()->back()->with('message', 'Veiksmīgi atcelts abonements.');
    }
}
