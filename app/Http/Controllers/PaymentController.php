<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class PaymentController extends Controller
{
    public function checkout(Appointment $appointment) {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Appointment Payment',
                    ],
                    'unit_amount' => $appointment->fee * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['appointment' => $appointment->id]),
            'cancel_url' => route('payment.cancel', ['appointment' => $appointment->id]),
        ]);

        return redirect($session->url);
    }

    public function success(Appointment $appointment)
    {
        $appointment->update(['status' => 'paid']);
        return redirect()->route('patient.dashboard')->with('success', 'Payment successful! Your appointment is confirmed.');
    }

    public function cancel(Appointment $appointment)
    {
        return redirect()->route('patient.dashboard')->with('error', 'Payment canceled.');
    }
};

