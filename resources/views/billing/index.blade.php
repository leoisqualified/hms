<x-layout title="Billing">
    <h2>Billing Records</h2>
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($billing as $bill)
                <tr>
                    <td>{{ $bill->patient->user->name }}</td>
                    <td>${{ number_format($bill->amount, 2) }}</td>
                    <td>{{ ucfirst($bill->status) }}</td>
                    <td>
                        <a href="{{ route('billing.show', $bill) }}">View</a>
                        <a href="{{ route('billing.edit', $bill) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
