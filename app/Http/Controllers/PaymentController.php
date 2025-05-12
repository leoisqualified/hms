<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Medication;

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

    public function checkoutBulk(Request $request)
{
    $request->validate([
        'total_amount' => 'required|numeric|min:0.01',
        'med_ids' => 'required|string',
    ]);

    $medIds = explode(',', $request->med_ids);
    $medications = Medication::whereIn('id', $medIds)->get();

    // Optional: Verify the total matches
    $expectedTotal = $medications->sum('price');
    if (round($expectedTotal, 2) != round($request->total_amount, 2)) {
        return back()->withErrors(['total_amount' => 'Payment amount mismatch.']);
    }

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Bulk Medication Payment',
                ],
                'unit_amount' => intval($expectedTotal * 100), // Stripe expects cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('payment.cancel'),
        'metadata' => [
            'med_ids' => implode(',', $medIds),
        ],
    ]);

    return redirect($session->url);
}
}
