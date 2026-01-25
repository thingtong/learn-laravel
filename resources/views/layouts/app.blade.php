<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name','E-Learning') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/courses">E-Learning</a>

        <div class="ms-auto text-white">
            {{ auth()->user()->name ?? '' }}
        </div>
    </div>
</nav> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('courses.index') }}">
            🎓 E-Learning
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Courses -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">
                        📚 Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.create') }}">
                        ➕ Add Course
                    </a>
                </li>
                
                <!-- Add Course (Admin + Teacher only) -->
                @auth
                    @if(in_array(auth()->user()->role, ['truetouch','teacher']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.create') }}">
                                ➕ Add Course
                            </a>
                        </li>
                    @endif
                @endauth

            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            👤 {{ auth()->user()->name }}
                            <small class="text-muted">({{ auth()->user()->role }})</small>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="#">
                                    🏠 Dashboard
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        🚪 Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>

