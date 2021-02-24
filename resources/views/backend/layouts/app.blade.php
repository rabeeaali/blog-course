<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title) {{ $title }} -@endisset Admin</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">

        @include('backend.layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">

            @include('backend.layouts.header')

            <!-- content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                {{ $slot }}
            </main>
            <!-- end content -->
        </div>
    </div>

</body>

</html>