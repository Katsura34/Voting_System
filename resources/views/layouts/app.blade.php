<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACLC Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar shadow-sm min-vh-100 p-0">
                <div class="sidebar-sticky pt-3 d-flex flex-column h-100">
                    <div class="d-flex flex-column px-3 pb-3 border-bottom">
                        <h1 class="fs-3 fw-bold text-primary">Voting System</h1>
                        <p class="fs-6 text-secondary">Admin Panel</p>
                    </div>

                    <ul class="nav flex-column mt-3 flex-grow-1">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-primary fw-semibold' : '' }}"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('positions.*') ? 'active text-primary fw-semibold' : '' }}"
                                       href="{{ route('positions.index') }}">
                                        <i class="bi bi-list-task"></i> Positions
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('parties.*') ? 'active text-primary fw-semibold' : '' }}"
                                       href="{{ route('parties.index') }}">
                                        <i class="bi bi-people-fill"></i> Parties
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('candidates.*') ? 'active text-primary fw-semibold' : '' }}"
                                       href="{{ route('candidates.index') }}">
                                        <i class="bi bi-person-badge"></i> Candidates
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('voting.index') ? 'active text-primary fw-semibold' : '' }}"
                                       href="{{ route('voting.index') }}">
                                        <i class="bi bi-bar-chart-line"></i> Voting Page
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <div class="mt-auto px-3 border-top pt-3">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger w-100 text-start">
                                      <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <header class="d-flex justify-content-between align-items-center py-3 border-bottom bg-white sticky-top">
                    <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <h2 class="fs-4 fw-semibold text-secondary">
                        {{ ucfirst(Str::afterLast(Route::currentRouteName(), '.')) ?? 'Dashboard' }}
                    </h2>

                    @auth
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                            </div>
                            <span class="fw-medium text-secondary">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </span>
                        </div>
                    @endauth
                </header>

                <section class="mt-4">
                    @yield('content')
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
