<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="flex items-center justify-between bg-white shadow px-8 py-4">
        <a href="/" class="text-xl font-bold text-gray-800">POS</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition" type="submit">Logout</button>
        </form>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        @yield('content')