<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Medication Payment'],
                    'unit_amount' => $request->amount * 100, // convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['med_id' => $request->med_id]), // <- include ID
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $medicationId = $request->query('med_id');

        if ($medicationId) {
            \App\Models\Medication::where('id', $medicationId)->update(['is_paid' => true]);
        }

        return view('patient.payment-success');
    }

    public function cancel()
    {
        return view('patient.payment-cancel');
    }
}
