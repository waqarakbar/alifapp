<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.15.2-web/css/all.min.css') }}">
@stack('css')

<!-- Scripts -->
    <script type="text/javascript" src="{{ asset('plugins/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">

        $(document).ready(function () {
            setTimeout(function(){
                $("#alerts-goes-here").fadeOut('2000')
            }, 4000)
        })

    </script>


    @stack('scripts')

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
@include('layouts.navigation')

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="alerts-goes-here">
        @if(\Illuminate\Support\Facades\Session::has('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ \Illuminate\Support\Facades\Session::get('success') }}</span>
            </div>

        @elseif(\Illuminate\Support\Facades\Session::has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ \Illuminate\Support\Facades\Session::get('error') }}</span>

            </div>
        @endif
    </div>


    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
