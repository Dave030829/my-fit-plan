<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
@extends('layouts.app')

@section('content')

    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Bejelentkezés</h1>

            <!-- Sikerüzenet megjelenítése -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

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

            <!-- Bejelentkezési űrlap -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- E-mail cím -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">E-mail cím:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Jelszó -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Jelszó:</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Bejelentkezés gomb -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Bejelentkezés
                </button>
            </form>

            <!-- Regisztrációs link -->
            <p class="mt-4 text-center text-gray-600">
                Nincs még fiókod? <a href="{{ route('register.create') }}"
                    class="text-indigo-600 hover:text-indigo-500">Regisztrálj itt</a>.
            </p>
        </div>
    </body>
@endsection

</html>
