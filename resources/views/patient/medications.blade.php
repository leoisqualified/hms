@extends('layouts.app')

@php
    $unpaidMeds = $medications->where('is_paid', false);
    $totalUnpaidPrice = $unpaidMeds->sum('price');
@endphp


@section('title', 'My Medications')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    My Prescribed Medications
                </h2>
                <p class="mt-1 text-sm text-gray-600">View and manage your current prescriptions</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm text-gray-500">Total Medications</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $medications->count() }}</p>
                </div>

                <div class="mt-4 sm:mt-0">
                    <div class="bg-white px-5 py-4 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Total Price</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">
                                    ${{ number_format($totalUnpaidPrice, 2) }}
                                </p>
                            </div>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medications Table -->
        @if ($medications->isEmpty())
            <div class="bg-white shadow rounded-lg overflow-hidden text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No medications prescribed</h3>
                <p class="mt-1 text-sm text-gray-500">You currently have no active prescriptions.</p>
            </div>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medication</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosage</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prescribed On</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($medications as $med)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $med->medication_name }}</div>
                                            {{-- <div class="text-sm text-gray-700 mt-1">
                                                <strong>Price:</strong> 
                                                {{ $med->price ? '$' . number_format($med->price, 2) : 'Price not set yet' }}
                                            </div> --}}
                                        </div>                                        
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $med->dosage }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $med->created_at->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $med->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($med->is_paid)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Payment Pending
                                        </span>
                                    @endif
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if ($med->is_paid)
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    @else
                                        <form action="{{ route('payment.checkout') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="amount" value="{{ $med->price }}">
                                            <input type="hidden" name="med_id" value="{{ $med->id }}">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Pay Now
                                            </button>
                                        </form>
                                    @endif
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($unpaidMeds->count())
                        <form action="{{ route('payment.checkout.bulk') }}" method="POST" class="mx-6 my-6  text-right">
                            @csrf
                            <input type="hidden" name="total_amount" value="{{ $totalUnpaidPrice }}">
                            <input type="hidden" name="med_ids" value="{{ $unpaidMeds->pluck('id')->join(',') }}">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                Pay All (${{ number_format($totalUnpaidPrice, 2) }})
                            </button>
                        </form>
                    @else
                        <p class="text-green-600 font-semibold mt-6">All medications are paid.</p>
                    @endif

                </div>
                <!-- Pagination would go here -->
            </div>
        @endif

        <!-- Additional Information Card -->
        <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Medication Information
                </h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-sm text-gray-600 mb-4">For any questions about your medications, side effects, or refill requests, please contact your healthcare provider.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Contact Pharmacy
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-green-700 bg-green-100 hover:bg-green-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Request Refill
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection