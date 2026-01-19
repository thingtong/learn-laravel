<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name','E-Learning') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/courses">E-Learning</a>

        <div class="ms-auto text-white">
            {{ auth()->user()->name ?? '' }}
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>