<!-- layout_institucional.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>F12 Rifas - Venda Rifas com Segurança e Controle</title>
</head>

<body class="bg-white text-gray-800">
    <section class="w-full">
        {{ $slot }}
    </section>
</body>
</html>
