<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>BookaBuku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.navbar')
    

    @yield('content')
    @include('layouts.auth-modal')
</body>
</html>