<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Payment;


class PrescriptionPaymentController extends Controller
{
    public function index() {
        // Get all appointments for the logged-in patient along with prescriptions
        $appointments = Appointment::where('patient_id', Auth::id())->with('prescriptions')->get();
    
        return view('patient.prescriptions', compact('appointments'));
    }
    
    
    public function payPrescription($id)
    {
        $prescription = Prescription::findOrFail($id);

        if ($prescription->paid) {
            return redirect()->route('patient.dashboard')->with('error', 'Prescription already paid.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $prescription->medication,
                    ],
                    'unit_amount' => $prescription->price * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('prescription.payment.success', $prescription->id),
            'cancel_url' => route('patient.dashboard'),
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->update(['paid' => true]);

        Payment::create([
            'appointment_id' => $prescription->appointment_id,
            'amount' => $prescription->price,
            'status' => 'completed',
            'payment_method' => 'Stripe',
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Prescription payment successful!');
    }
}
