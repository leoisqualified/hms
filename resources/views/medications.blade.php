<form action="{{ route('payment.checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="amount" value="5000"> <!-- $50.00 -->
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Pay for Medication</button>
</form>
