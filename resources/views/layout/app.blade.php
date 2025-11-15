<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Office Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN for simplicity --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- jQuery + DataTables CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        /* small convenience */
        .container { max-width:1100px; margin:20px auto; padding:0 16px; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container">
        <header class="flex items-center justify-between py-4">
            <h1 class="text-2xl font-bold">Office Management</h1>
            <nav class="space-x-4">
                <a href="{{ route('employees.index') }}" class="text-blue-600">Employees</a>
                <a href="{{ route('companies.index') }}" class="text-blue-600">Companies</a>
            </nav>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
