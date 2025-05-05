<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand fw-bolder" href="{{ route('admin.dashboard') }}">MyApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active fw-bolder text-dark' : '' }}"
                                href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('products.index') ? 'active fw-bolder text-dark' : '' }}"
                                href="{{ route('products.index') }}">Products</a>
                        </li>
                        @if (Route::has('login'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Abdelfatah Obaid') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="py-5">
        <div style="position: fixed; top: 20px; left: 20px; z-index: 9999; min-width: 300px;">
            @foreach (['success', 'error', 'warning'] as $type)
                @if (session($type))
                    <div class="alert alert-{{ $type == 'error' ? 'danger' : $type }} alert-dismissible fade show shadow-lg border-0 rounded-3"
                        role="alert">
                        <strong>
                            @if ($type == 'success')
                                ✅ success
                            @elseif($type == 'error')
                                ❌ error
                            @elseif($type == 'warning')
                                ⚠️ warning
                            @endif
                        </strong>
                        {{ session($type) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; {{ date('Y') }} Laravel App. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
    <script>
        // اختفاء الإشعار بعد 4.5 ثوانٍ تلقائيًا
        document.addEventListener('DOMContentLoaded', function() {
            const alertBox = document.querySelector('.alert');
            if (alertBox) {
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertBox);
                    bsAlert.close();
                }, 4500); // 4.5 seconds
            }
        });
    </script>
</body>

</html>
