@extends('layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl">
    <h2 class="text-xl mb-4">Edit Employee</h2>

    <form action="{{ route('employees.update', $employee) }}" method="POST" id="employeeForm">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ $employee->name }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Phone</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="block">Company</label>
            <select name="company_id" class="w-full border p-2" required>
                <option value="">Select company</option>
                @foreach($companies as $c)
                <option value="{{ $c->id }}" @if($employee->company_id == $c->id) selected @endif>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Manager</label>
            <select name="manager_id" class="w-full border p-2">
                <option value="">None</option>
                @foreach($managers as $m)
                <option value="{{ $m->id }}" @if($employee->manager_id == $m->id) selected @endif>{{ $m->name }}</option>
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
            <input type="text" name="position" value="{{ $employee->position }}" class="w-full border p-2">
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    const selected = {
        country: @json($employee->country),
        state: @json($employee->state),
        city: @json($employee->city)
    };

    function loadCountries() {
        $('#country').html('<option>Loading...</option>');
        $.get("{{ route('locations.countries') }}").done(function(data){
            $('#country').empty().append('<option value="">Select Country</option>');
            data.forEach(function(c){
                const val = c.country_name || c;
                $('#country').append(`<option value="${val}" ${val==selected.country ? 'selected' : '' }>${val}</option>`);
            });
            if (selected.country) $('#country').trigger('change');
        });
    }

    $('#country').on('change', function(){
        const country = $(this).val();
        $('#state').html('<option>Loading...</option>');
        $('#city').html('<option value="">Select City</option>');
        if (!country) { $('#state').empty(); return; }
        $.get("{{ url('/locations/states') }}/" + encodeURIComponent(country)).done(function(data){
            $('#state').empty().append('<option value="">Select State</option>');
            data.forEach(function(s){
                const val = s.state_name || s;
                $('#state').append(`<option value="${val}" ${val==selected.state ? 'selected' : '' }>${val}</option>`);
            });
            if (selected.state) $('#state').trigger('change');
        });
    });

    $('#state').on('change', function(){
        const state = $(this).val();
        $('#city').html('<option>Loading...</option>');
        if (!state) { $('#city').empty(); return; }
        $.get("{{ url('/locations/cities') }}/" + encodeURIComponent(state)).done(function(data){
            $('#city').empty().append('<option value="">Select City</option>');
            data.forEach(function(c){
                const val = c.city_name || c;
                $('#city').append(`<option value="${val}" ${val==selected.city ? 'selected' : '' }>${val}</option>`);
            });
        });
    });

    loadCountries();
});
</script>
@endpush
