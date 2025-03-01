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

    <body class="bg-gradient-to-br from-purple-500 to-indigo-600 min-h-screen p-4">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Bal oszlop (Profil szerkesztése) -->
            <div>
                <div class="bg-white rounded-2xl shadow-2xl w-full mt-5 mb-5 p-8">
                    <!-- Fejléc -->
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <i
                                class="fas fa-user-edit text-4xl bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent"></i>
                        </div>
                        <h1
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">
                            Profil adatai
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

                    <!-- Hibák és sikerüzenetek -->
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
                </div>

                <!-- Profil Szerkesztő űrlap -->
                <div class="bg-white rounded-2xl shadow-2xl w-full mt-5 mb-5 p-8">
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <i
                                class="fas fa-user-edit text-4xl bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent"></i>
                        </div>
                        <h1
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent">
                            Profil szerkesztése
                        </h1>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Életkor slider -->
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Életkor:
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

                        <!-- Nem select -->
                        <div class="relative group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nem</label>
                            <div class="relative">
                                <select name="gender" id="gender"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl appearance-none
                                    focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all cursor-pointer">
                                    <option value="">Válassz...</option>
                                    <option value="male" {{ (Auth::user()->gender ?? '') == 'male' ? 'selected' : '' }}>
                                        Férfi</option>
                                    <option value="female" {{ (Auth::user()->gender ?? '') == 'female' ? 'selected' : '' }}>
                                        Nő</option>
                                    <option value="other" {{ (Auth::user()->gender ?? '') == 'other' ? 'selected' : '' }}>
                                        Egyéb</option>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <i
                                        class="fas fa-chevron-down text-gray-400 group-hover:text-purple-600 transition-colors"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Súly input -->
                        <div class="group">
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Súly (kg)</label>
                            <input type="number" name="weight" id="weight" min="0" max="300" step="1"
                                value="{{ Auth::user()->weight ?? '' }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                                placeholder="pl. 70">
                        </div>

                        <!-- Magasság input -->
                        <div class="group">
                            <label for="height" class="block text-sm font-medium text-gray-700 mb-2">Magasság (cm)</label>
                            <input type="number" name="height" id="height" min="50" max="250" step="1"
                                value="{{ Auth::user()->height ?? '' }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                                placeholder="pl. 170">
                        </div>

                        <!-- Frissítés gomb -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-blue-500 text-white py-3 px-6
                            rounded-xl font-semibold shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-[1.02] active:scale-95">
                            Frissítés
                            <i class="fas fa-sync-alt ml-2 animate-spin-on-hover"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Jobb oszlop (Napi összegzés) -->
            <div>
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-2xl  mb-5 mt-5 w-full mx-auto">
                    <div class="text-center mb-8 mt-5">
                        <i
                            class="fa-solid fa-list text-4xl bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent mb-2"></i>
                        <h2
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent mb-5">
                            Napi összegzés</h2>

                    </div>
                    <div class="flex flex-col md:flex-row gap-6 items-stretch">
                        <!-- Progress Ring  -->
                        <div class="md:w-1/3 flex flex-col items-center p-4 bg-indigo-50 rounded-xl">
                            <div class="relative w-36 h-36 mb-4">
                                <svg viewBox="0 0 100 100" class="transform -rotate-90 w-full h-full">
                                    <!-- Háttér kör -->
                                    <circle cx="50" cy="50" r="45" stroke="currentColor"
                                        class="text-gray-200" stroke-width="8" fill="none" />
                                    <!-- Progress kör -->
                                    <circle id="calorieRing" cx="50" cy="50" r="45" stroke="currentColor"
                                        class="text-indigo-500" stroke-width="8" stroke-linecap="round" fill="none"
                                        stroke-dasharray="283" stroke-dashoffset="283" />
                                </svg>
                                <!-- Középső felirat -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <p class="text-2xl md:text-3xl font-bold text-gray-800" id="totalKcalRing">0</p>
                                    <p class="text-sm text-gray-500 mt-1">kcal</p>
                                </div>
                            </div>
                            <div class="text-center bg-blue-200 p-2 px-10 rounded-xl">
                                <h3 class="font-semibold text-blue-700 mb-1">Kalória limit</h3>
                                <p class="text-md text-blue-500">{{ Auth::user()->calorie_goal }} kcal</p>
                            </div>
                        </div>

                        <div class="md:w-2/3 flex flex-col gap-4">
                            <!-- Protein Card -->
                            <div class="bg-gradient-to-br from-red-500 to-red-300 p-4 rounded-xl shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-white mb-1">Fehérje</p>
                                        <p class="text-xl font-bold text-white" id="totalProtein">0 g</p>
                                    </div>
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-fish text-red-700"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Fat Card -->
                            <div class="bg-gradient-to-br from-yellow-500 to-yellow-300 p-4 rounded-xl shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-white mb-1">Zsír</p>
                                        <p class="text-xl font-bold text-white" id="totalFat">0 g</p>
                                    </div>
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-droplet text-yellow-700"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Carbs Card -->
                            <div class="bg-gradient-to-br from-blue-500 to-blue-300 p-4 rounded-xl shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-white mb-1">Szénhidrát</p>
                                        <p class="text-xl font-bold text-white" id="totalCarbs">0 g</p>
                                    </div>
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-bread-slice text-blue-700"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const summary = localStorage.getItem('dailySummary');
                if (summary) {
                    const data = JSON.parse(summary);
                    document.getElementById('totalKcalRing').textContent = Math.round(data.kcal);
                    document.getElementById('totalProtein').textContent = `${data.protein.toFixed(1)} g`;
                    document.getElementById('totalFat').textContent = `${data.fat.toFixed(1)} g`;
                    document.getElementById('totalCarbs').textContent = `${data.carbs.toFixed(1)} g`;
                    const userGoal = parseFloat("{{ Auth::user()->calorie_goal ?? 0 }}");
                    updateProgress(data.kcal, userGoal);
                }
            });

            function updateProgress(current, goal) {
                const ring = document.getElementById('calorieRing');
                const circumference = 283;
                let ratio = 0;
                if (goal > 0) {
                    ratio = current / goal;
                    if (ratio > 1) ratio = 1;
                }
                const offset = circumference - (ratio * circumference);
                ring.style.strokeDashoffset = offset;
                if (ratio < 0.7) {
                    ring.style.stroke = "#22C55E";
                } else if (ratio < 0.95) {
                    ring.style.stroke = "#FBBF24";
                } else {
                    ring.style.stroke = "#EF4444";
                }
            }
        </script>
    </body>
@endsection
