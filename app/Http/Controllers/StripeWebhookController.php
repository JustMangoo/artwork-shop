<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve the event by verifying the signature using the raw body and secret
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                env('STRIPE_WEBHOOK_SECRET')
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Webhook error: Invalid Payload');
            return response()->json(['error' => 'Invalid Payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Webhook error: Invalid Signature');
            return response()->json(['error' => 'Invalid Signature'], 400);
        }

        // Handle the event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Here you save the relevant data
            $this->handleCheckoutSession($session);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleCheckoutSession($session)
    {
        $order = Order::where('session_id', $session->id)->first();
        if ($order) {
            Log::info('Session Data:', ['session' => $session]); // Log entire session data
            $order->status = 'paid';

            // Update the email using customer_details
            if (isset($session->customer_details->email)) {
                $order->email = $session->customer_details->email;
            }
            if (isset($session->customer_details->name)) {
                $order->full_name = $session->customer_details->name;
            }
            if (isset($session->customer_details->phone)) {
                $order->phone_number = $session->customer_details->phone;
            }

            // Update the shipping details using shipping_details
            if (isset($session->shipping_details)) {
                $order->shipping_address = $session->shipping_details->address->line1;
                $order->shipping_city = $session->shipping_details->address->city;
                $order->shipping_country = $session->shipping_details->address->country;
                $order->shipping_postal_code = $session->shipping_details->address->postal_code;
            }

            $order->save();
        }
    }

}
