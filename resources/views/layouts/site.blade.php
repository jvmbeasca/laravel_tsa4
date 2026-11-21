<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tasks for Today')</title>

    <style>
        * {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
}

.topbar {
    background: #0f172a;
    color: white;
    padding: 18px 5%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.brand {
    font-size: 22px;
    font-weight: bold;
}

.brand span {
    color: #38bdf8;
}

nav {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;
}

nav a {
    color: #cbd5e1;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    color: #38bdf8;
}

nav form button {
    background: transparent;
    border: 0;
    color: #cbd5e1;
    cursor: pointer;
    font: inherit;
    font-weight: bold;
}

.page-wrapper {
    width: 92%;
    max-width: 1150px;
    margin: 40px auto;
}

.welcome {
    background: linear-gradient(135deg, #0284c7, #0f172a);
    color: white;
    padding: 30px;
    border-radius: 14px;
    margin-bottom: 24px;
}

.welcome h1 {
    color: white;
    margin-top: 0;
}

.content-card {
    background: white;
    padding: 24px;
    border-radius: 14px;
    box-shadow: 0 5px 16px rgba(15, 23, 42, 0.08);
}

h1, h2 {
    color: #0f172a;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 18px;
}

th {
    background: #0284c7;
    color: white;
    text-align: left;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #e2e8f0;
}

tr:nth-child(even) {
    background: #f8fafc;
}

input, select {
    padding: 8px;
    margin-top: 5px;
    max-width: 100%;
}

button {
    padding: 8px 12px;
    cursor: pointer;
}

footer {
    text-align: center;
    padding: 24px;
    color: #64748b;
}

@media (max-width: 700px) {
    .topbar {
        display: block;
    }

    nav {
        margin-top: 16px;
        gap: 12px;
    }

    .page-wrapper {
        width: 95%;
        margin: 24px auto;
    }

    .content-card {
        padding: 16px;
        overflow-x: auto;
    }
}
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">
            Tasks<span>Today</span>
        </div>

        <nav>
            <a href="{{ route('home') }}">Welcome</a>
            <a href="{{ route('tasks.index') }}">Task List</a>
            <a href="{{ route('profile') }}">Profile</a>
            <a href="{{ route('about') }}">About</a>

            @auth
                <a href="{{ route('tasks.create') }}">Create Task</a>
                <a href="{{ route('tasks.archived') }}">Archived Tasks</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main class="page-wrapper">
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @yield('content')
    </main>

    <footer>
        Tasks for Today &copy; {{ date('Y') }}
    </footer>
</body>
</html>