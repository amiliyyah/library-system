<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Library System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Library System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            @auth
            <ul class="navbar-nav me-auto">
                @can('staff')
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('borrowings.index') }}">Peminjaman</a></li>
                @endcan
                @can('manage-users')
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Kelola Pengguna</a></li>
                @endcan
            </ul>

            <span class="navbar-text me-3">
                {{ auth()->user()->name }}
                <span class="badge bg-secondary">{{ auth()->user()->role }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-secondary btn-sm">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>

<main class="container flex-grow-1">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer class="text-center text-muted py-3 mt-4 border-top">
    &copy; 2026 Amilia Hesty Ramadhani
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>