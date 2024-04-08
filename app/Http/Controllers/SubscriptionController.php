<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create($validatedData);

        return redirect()->back()->with('message', 'Subscription successful.');
    }

    public function unsubscribe($email)
    {
        $subscription = Subscription::where('email', $email)->firstOrFail();
        $subscription->delete();

        return redirect()->back()->with('message', 'Unsubscribed successfully.');
    }
}
