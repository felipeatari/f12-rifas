<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>F12 Rifas - Venda Rifas com Segurança e Controle</title>
</head>

<body class="bg-[#0a0a0a] text-white">
    <section class="w-full min-h-screen flex items-center justify-center">
        {{ $slot }}
    </section>
</body>

</html>
