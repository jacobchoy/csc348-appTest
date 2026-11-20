<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <header class="container">
        <nav aria-label="Primary navigation">
            <ul>
                <li><strong>Plane App</strong></li>
            </ul>
            <ul>
                <li>{{ auth()->user()->name }} ({{ auth()->user()->role }})</li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="secondary">Log out</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Welcome to the Plane App</h1>
        <p>You are signed in.</p>
    </main>
</body>
</html>
