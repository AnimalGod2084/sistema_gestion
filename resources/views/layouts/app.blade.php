<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema Gestion') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; width: 250px; background-color: #343a40; position: fixed; top: 0; left: 0; z-index: 100; transition: width 0.2s; }
        .sidebar .nav-link { color: #adb5bd; padding: 12px 20px; display: flex; align-items: center; gap: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: rgba(255,255,255,0.1); }
        .sidebar .nav-link i { font-size: 1.1rem; width: 24px; text-align: center; }
        .sidebar-brand { padding: 20px; color: #fff; font-size: 1.25rem; font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .main-content { margin-left: 250px; min-height: 100vh; }
        .topbar { background-color: #fff; padding: 15px 20px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; }
        .content-wrapper { padding: 20px; }
        .card-dashboard { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 10px; }
    </style>
</head>
<body>
    <div class="d-flex">
        @auth
        <aside class="sidebar d-flex flex-column">
            <div class="sidebar-brand">
                <i class="bi bi-gear-wide-connected"></i> Sistema Gestion
            </div>
            <nav class="nav flex-column mt-3">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('entradas.*') ? 'active' : '' }}" href="{{ route('entradas.index') }}">
                    <i class="bi bi-box-arrow-in-right"></i> Entradas
                </a>
                <a class="nav-link {{ request()->routeIs('asignaciones.*') ? 'active' : '' }}" href="{{ route('asignaciones.index') }}">
                    <i class="bi bi-people"></i> Asignaciones
                </a>
                <a class="nav-link {{ request()->routeIs('merma.*') ? 'active' : '' }}" href="{{ route('merma.index') }}">
                    <i class="bi bi-trash"></i> Merma
                </a>
                <a class="nav-link {{ request()->routeIs('informes.*') ? 'active' : '' }}" href="{{ route('informes.index') }}">
                    <i class="bi bi-file-earmark-bar-graph"></i> Informes
                </a>
            </nav>
            <div class="mt-auto p-3 border-top border-secondary">
                <div class="text-light small mb-2">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light w-100">
                        <i class="bi bi-box-arrow-left"></i> Cerrar Sesion
                    </button>
                </form>
            </div>
        </aside>
        @endauth

        <div class="main-content flex-grow-1">
            @auth
            <div class="topbar">
                <span class="fw-semibold text-secondary">{{ __('Sistema de Gestion') }}</span>
                <span class="text-muted small">{{ Auth::user()->email }}</span>
            </div>
            @endauth

            @isset($header)
            <div class="content-wrapper pb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    {{ $header }}
                </div>
            </div>
            @endisset

            <div class="content-wrapper">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
