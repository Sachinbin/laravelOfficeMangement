@extends('layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Employees</h2>
        <div>
            <a href="{{ route('employees.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Add Employee</a>
        </div>
    </div>

    <div class="mb-4 flex gap-4">
        <select id="filterCompany" class="border p-2">
            <option value="">All Companies</option>
            @foreach($companies as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <input id="filterPosition" placeholder="Filter by position" class="border p-2" />
        <button id="applyFilters" class="px-3 py-2 bg-gray-200">Apply</button>
        <button id="clearFilters" class="px-3 py-2 bg-gray-200">Clear</button>
    </div>

    <table id="employeeTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Manager</th>
                <th>Position</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    function loadTable(company = '', position = '') {
        if ($.fn.dataTable.isDataTable('#employeeTable')) {
            $('#employeeTable').DataTable().destroy();
            $('#employeeTable').empty();
            $('#employeeTable').append('<thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Manager</th><th>Position</th><th>Location</th><th>Action</th></tr></thead>');
        }

        $('#employeeTable').DataTable({
            ajax: {
                url: "{{ route('employees.index') }}",
                data: { company_id: company, position: position },
                dataSrc: 'data'
            },
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'company.name', defaultContent: '' },
                { data: 'manager.name', defaultContent: '' },
                { data: 'position', defaultContent: '' },
                { data: null, render: function (d) {
                    return (d.city ? d.city + ', ' : '') + (d.state ? d.state + ', ' : '') + (d.country ? d.country : '');
                }},
                { data: null, orderable:false, searchable:false, render: function(d) {
                    var edit = `<a href="/employees/${d.id}/edit" class="text-indigo-600">Edit</a>`;
                    var del = `<form action="/employees/${d.id}" method="POST" style="display:inline">@csrf<input type="hidden" name="_method" value="DELETE"><button onclick="return confirm('Delete?')" class="text-red-600 ml-2">Delete</button></form>`;
                    return edit + del;
                }}
            ],
            pageLength: 10
        });
    }

    loadTable();

    $('#applyFilters').on('click', function(){
        const company = $('#filterCompany').val();
        const position = $('#filterPosition').val();
        loadTable(company, position);
    });

    $('#clearFilters').on('click', function(){
        $('#filterCompany').val('');
        $('#filterPosition').val('');
        loadTable();
    });
});
</script>
@endpush
