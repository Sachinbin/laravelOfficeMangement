@extends('layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Companies</h2>
        <a href="{{ route('companies.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Add Company</a>
    </div>

    <table class="min-w-full divide-y" id="companiesTable">
        <thead>
            <tr class="text-left">
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->location }}</td>
                <td class="space-x-2">
                    <a href="{{ route('companies.edit', $c) }}" class="text-indigo-600">Edit</a>
                    <form action="{{ route('companies.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

