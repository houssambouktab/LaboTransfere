<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laboratoire') — Labo Santé</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="mobile-overlay" data-overlay></div>
<div class="app-shell">
    @include('components.sidebar')
    <div class="main-area">
        @include('components.navbar')
        <main class="content">@yield('content')</main>
    </div>
</div>
<div class="toast" data-toast><span>✓</span><span data-toast-message></span></div>
</body>
</html>
