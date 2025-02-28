<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
@extends('layouts.app')

@section('content')
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Regisztráció</h1>

        <!-- Hibák megjelenítése -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Regisztrációs űrlap -->
        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <!-- Felhasználónév -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Felhasználónév:</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- E-mail cím -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">E-mail cím:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Jelszó -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Jelszó:</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Jelszó megerősítése -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700">Jelszó megerősítése:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Regisztráció gomb -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Regisztráció
            </button>
        </form>

        <!-- Bejelentkezési link -->
        <p class="mt-4 text-center text-gray-600">
            Már van fiókod? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">Jelentkezz be itt</a>.
        </p>
    </div>
</body>
@endsection
</html>