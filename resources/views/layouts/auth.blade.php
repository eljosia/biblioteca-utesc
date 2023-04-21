<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <section class="row justify-content-center align-items-center" style="height: 100vh; background-color:var(--x-gray-200);">
        @yield('content')
    </section>
</body>

</html>