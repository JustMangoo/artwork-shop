<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscription;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ], [
            'email.unique' => 'Šis e-pasts ir jau reģistrēts.',
        ]);

        $subscription = Subscription::create($validatedData);

        $unsubscribeToken = Crypt::encryptString($subscription->email);
        $unsubscribeLink = route('unsubscribe', ['token' => $unsubscribeToken]);

        Mail::to($validatedData['email'])->send(new NewsletterSubscription($validatedData, $unsubscribeLink));

        return redirect()->back()->with('success', 'Abonēšana ir veiksmīga.');
    }

    public function unsubscribe($token)
    {
        try {
            $email = Crypt::decryptString($token);
            $subscription = Subscription::where('email', $email)->firstOrFail();
            $subscription->delete();

            return redirect()->route('home')->with('message', 'Veiksmīgi atcelts abonements.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Neizdevās atcelt abonementu.');
        }
    }
}

