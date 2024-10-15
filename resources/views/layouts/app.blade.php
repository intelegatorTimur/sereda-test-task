{{-- resources/views/layouts/app.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sereda test task')</title>
</head>
<body>
<header>
    <h1>Sereda test task</h1>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
