<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            h1, h2, h3, .text-brand {
              font-family: "Anton", sans-serif;
              font-weight: 400;
              font-style: normal;
            }
        </style>
    </head>
    <body class="bg-gray-100 pb-8">
        <header class="flex justify-center items-center bg-white text-center">
            <div class="w-[160px] mr-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" >
            </div>
            <h1 style="font-size: 3em;">Dashboard</h1>
        </header>
        <div class="max-w-4xl mx-auto px-4">
            {{ $slot }}
        </div>
    </body>
</html>
