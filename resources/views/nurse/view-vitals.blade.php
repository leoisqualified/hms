<h1>Vitals for {{ $patient->name }}</h1>
<ul>
    @forelse($vitals as $vital)
        <li>{{ $vital->created_at }} - Temp: {{ $vital->temperature }}, BP: {{ $vital->blood_pressure }}</li>
    @empty
        <li>No vitals recorded yet.</li>
    @endforelse
</ul>
