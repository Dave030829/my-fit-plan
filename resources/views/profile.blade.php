<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil kitöltése</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
@extends('layouts.app')

@section('content')

    <body class="bg-gradient-to-br from-purple-500 to-indigo-600 min-h-screen flex items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-transform duration-300 hover:scale-105">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="mb-4">
                        <i
                            class="fas fa-user-edit text-4xl bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent"></i>
                    </div>
                    <h1
                        class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">
                        Profil Szerkesztése
                    </h1>
                </div>

                <!-- Felhasználói infók -->
                <div class="grid gap-4 mb-8">
                    <div
                        class="flex items-center bg-gray-50 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100">
                        <i class="fas fa-user text-purple-600 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Felhasználónév</p>
                            <p class="font-semibold">{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center bg-gray-50 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100">
                        <i class="fas fa-envelope text-blue-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Email cím</p>
                            <p class="font-semibold">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center bg-gray-50 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100">
                        <i class="fas fa-lock text-green-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Jelszó</p>
                            <p class="font-semibold">••••••••</p>
                        </div>
                    </div>
                </div>

                <!-- Hiba üzenet -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg animate-fade-in">
                        <div class="flex">
                            <i class="fas fa-times-circle text-red-500 mr-3 mt-1"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p class="text-sm text-red-700">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg animate-fade-in">
                        <div class="flex">
                            <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Életkor slider -->
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Életkor:
                            <span class="text-purple-600 font-bold" id="ageValue">{{ Auth::user()->age ?? 25 }}</span>
                        </label>
                        <div class="relative">
                            <input type="range" name="age" id="age" min="10" max="90"
                                value="{{ Auth::user()->age ?? 25 }}"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer
                                      [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4
                                      [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-purple-600
                                      [&::-webkit-slider-thumb]:appearance-none
                                      hover:[&::-webkit-slider-thumb]:scale-125 transition-all"
                                oninput="document.getElementById('ageValue').textContent = this.value">
                        </div>
                    </div>

                    <!-- Nem/(Gender) Select -->
                    <div class="relative group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nem</label>
                        <div class="relative">
                            <select name="gender" id="gender"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl appearance-none
                                       focus:border-purple-500 focus:ring-2 focus:ring-purple-200
                                       transition-all cursor-pointer">
                                <option value="">Válassz...</option>
                                <option value="male" {{ (Auth::user()->gender ?? '') == 'male' ? 'selected' : '' }}>Férfi
                                </option>
                                <option value="female" {{ (Auth::user()->gender ?? '') == 'female' ? 'selected' : '' }}>Nő
                                </option>
                                <option value="other" {{ (Auth::user()->gender ?? '') == 'other' ? 'selected' : '' }}>
                                    Balfasz</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-chevron-down text-gray-400 group-hover:text-purple-600 transition-colors"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Submit gomb -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-blue-500 text-white py-3 px-6
                               rounded-xl font-semibold shadow-lg hover:shadow-xl
                               transform transition-all duration-200 hover:scale-[1.02]
                               active:scale-95">
                        Frissítés
                        <i class="fas fa-sync-alt ml-2 animate-spin-on-hover"></i>
                    </button>
                </form>
            </div>
        </div>

        <style>
            .animate-fade-in {
                animation: fadeIn 0.3s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-spin-on-hover:hover i {
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }
        </style>
    </body>
@endsection

</html>
