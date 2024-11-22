<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <x-application-icon />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    {{--FontsはCDN。viteのapp.cssにまとめない方がいいらしい。読み込みに時間がかかり時崩れの可能性があるため。--}}

    <!-- Scripts -->
    @vite([
    'resources/css/app.css',
    'resources/css/pagination.css',
    'resources/js/app.js',
    ])
</head>

<body class="font-sans antialiased min-h-screen bg-gray-100"">
    @include('layouts.navigation')
    <!-- Page Heading -->
    @if (isset($header))
    <header class=" bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
        @if (session('message'))
        <div class="alert alert-success border px-4 py-3 rounded relative bg-green-100 border-green-400 text-green-700">
            {{ session('message') }}
        </div>
        @endif
    </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
            {{ $slot }}
        </div>
    </main>
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <hr class="mt-2 border-gray-300 rounded">
        <footer class="flex justify-center">
            <p class="my-3 text-gray-900 text-sm">&copy; 2024 Yamakawa</p>
        </footer>
    </div>
</body>

</html>