@extends('layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl mb-4">Edit Company</h2>

    <form action="{{ route('companies.update', $company) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Location</label>
            <input type="text" name="location" value="{{ $company->location }}" class="w-full border p-2">
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
    </form>
</div>
@endsection
