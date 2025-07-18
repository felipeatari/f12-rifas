<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.ico') }}">
    @vite('resources/css/app.css')
    @php
        $route = Route::currentRouteName();
    @endphp
    @if ($route === 'login')
        <title>F12 Rifas - Logar</title>
    @elseif ($route === 'register')
        <title>F12 Rifas - Cadastrar</title>
    @else
        <title>F12 Rifas</title>
    @endif
</head>

<body class="bg-[#0a0a0a] text-white">
    <section class="w-full flex items-center justify-center">
        {{ $slot }}
    </section>
</body>

</html>
