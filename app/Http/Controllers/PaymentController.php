<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Appointment;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function payAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->is_paid) {
            return redirect()->route('patient.dashboard')->with('error', 'Appointment already paid.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Doctor Appointment',
                    ],
                    'unit_amount' => 5000, // $50 (Stripe handles amounts in cents)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $appointment->id),
            'cancel_url' => route('patient.dashboard'),
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['is_paid' => true]);

        Payment::create([
            'appointment_id' => $appointment->id,
            'amount' => 50.00,
            'status' => 'completed',
            'payment_method' => 'Stripe',
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Payment successful!');
    }
}
