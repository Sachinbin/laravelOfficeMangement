@extends('layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl">
    <h2 class="text-xl mb-4">Create Employee</h2>

    <form action="{{ route('employees.store') }}" method="POST" id="employeeForm">
        @csrf

        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Phone</label>
            <input type="text" name="phone" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="block">Company</label>
            <select name="company_id" class="w-full border p-2" required>
                <option value="">Select company</option>
                @foreach($companies as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Manager</label>
            <select name="manager_id" class="w-full border p-2">
                <option value="">None</option>
                @foreach($managers as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 grid grid-cols-3 gap-2">
            <div>
                <label class="block">Country</label>
                <select id="country" name="country" class="w-full border p-2"></select>
            </div>
            <div>
                <label class="block">State</label>
                <select id="state" name="state" class="w-full border p-2"></select>
            </div>
            <div>
                <label class="block">City</label>
                <select id="city" name="city" class="w-full border p-2"></select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block">Position</label>
            <input type="text" name="position" class="w-full border p-2">
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    // Load countries
    function loadCountries() {
        $('#country').html('<option>Loading...</option>');
        $.get("{{ route('locations.countries') }}").done(function(data){
            $('#country').empty().append('<option value="">Select Country</option>');
            data.forEach(function(c){
                $('#country').append(`<option value="${c.country_name || c}">${c.country_name || c}</option>`);
            });
        }).fail(function(){ alert('Failed to load countries'); });
    }

    $('#country').on('change', function(){
        const country = $(this).val();
        $('#state').html('<option>Loading...</option>');
        $('#city').html('<option value="">Select City</option>');
        if (!country) { $('#state').empty(); return; }
        $.get("{{ url('/locations/states') }}/" + encodeURIComponent(country)).done(function(data){
            $('#state').empty().append('<option value="">Select State</option>');
            data.forEach(function(s){
                $('#state').append(`<option value="${s.state_name || s}">${s.state_name || s}</option>`);
            });
        }).fail(function(){ alert('Failed to load states'); });
    });

    $('#state').on('change', function(){
        const state = $(this).val();
        $('#city').html('<option>Loading...</option>');
        if (!state) { $('#city').empty(); return; }
        $.get("{{ url('/locations/cities') }}/" + encodeURIComponent(state)).done(function(data){
            $('#city').empty().append('<option value="">Select City</option>');
            data.forEach(function(c){
                $('#city').append(`<option value="${c.city_name || c}">${c.city_name || c}</option>`);
            });
        }).fail(function(){ alert('Failed to load cities'); });
    });

    loadCountries();
});
</script>
@endpush
