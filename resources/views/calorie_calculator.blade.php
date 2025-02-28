<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Kalória Kalkulátor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-50 to-indigo-50 min-h-screen py-10">
        <div class="max-w-xl mx-auto bg-white/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl mt-5 mb-5">
            <div class="text-center mb-8">
                <h1
                    class="text-4xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent inline-block mb-2">
                    <i class="fas fa-calculator mr-2"></i>Kalória Kalkulátor
                </h1>
                <p class="text-gray-600">
                    Számold ki a napi kalóriaszükségleted a céljaidnak megfelelően!
                </p>
            </div>

            @php
                $defaultAge = Auth::check() ? Auth::user()->age : '';
                $defaultGender = Auth::check() ? Auth::user()->gender : '';
            @endphp

            <div class="space-y-6">
                <!-- Nem (Gender) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700">Nemed:</label>
                    <div class="flex items-center space-x-8">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="gender" value="male" class="form-radio h-5 w-5 text-purple-600"
                                {{ $defaultGender === 'male' ? 'checked' : '' }}>
                            <span>Férfi</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="gender" value="female" class="form-radio h-5 w-5 text-purple-600"
                                {{ $defaultGender === 'female' ? 'checked' : '' }}>
                            <span>Nő</span>
                        </label>
                    </div>
                </div>

                <!-- Életkor (Age) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="ageInput">
                        Életkor (év):
                    </label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="ageInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl 
                               focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                            placeholder="Pl. 30" value="{{ $defaultAge }}" />
                    </div>
                </div>

                <!-- Testsúly (Weight) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="weightInput">
                        Testsúly (kg):
                    </label>
                    <div class="relative">
                        <i
                            class="fas fa-weight-hanging absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="weightInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl 
                               focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                            placeholder="Pl. 70" />
                    </div>
                </div>

                <!-- Magasság (Height) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="heightInput">
                        Magasság (cm):
                    </label>
                    <div class="relative">
                        <i
                            class="fas fa-ruler-combined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="heightInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl 
                               focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                            placeholder="Pl. 175" />
                    </div>
                </div>

                <!-- Aktivitási szint -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Aktivitási szint:</label>
                    <div class="space-y-2 bg-purple-50 p-4 rounded-xl border border-purple-200">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="activity" value="1.2" class="form-radio text-purple-600" checked>
                            <span>Ülő életmód (nagyon kevés mozgás)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="activity" value="1.375" class="form-radio text-purple-600">
                            <span>Kicsit aktív (heti 1-3 edzés)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="activity" value="1.55" class="form-radio text-purple-600">
                            <span>Közepesen aktív (heti 3-5 edzés)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="activity" value="1.725" class="form-radio text-purple-600">
                            <span>Nagyon aktív (heti 6-7 edzés)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="activity" value="1.9" class="form-radio text-purple-600">
                            <span>Szuper aktív (napi több edzés, fizikai munka)</span>
                        </label>
                    </div>
                </div>

                <!-- Számolás gomb -->
                <div class="mt-6 text-center">
                    <button onclick="calculateCalories()"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-xl 
                           hover:from-purple-700 hover:to-indigo-700 transition-all transform hover:scale-105 
                           shadow-lg hover:shadow-xl inline-flex items-center">
                        <i class="fas fa-calculator mr-2"></i>Számolás
                    </button>
                </div>
            </div>

            <!-- Eredmények -->
            <div id="resultsSection" class="mt-10 hidden">
                <h2 class="text-2xl font-bold text-purple-600 mb-4">Eredmények:</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Fenntartási kalória -->
                    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 p-4 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-light">Fenntartási kalória</p>
                                <p class="text-xl font-bold mt-1" id="maintenanceResult">-</p>
                            </div>
                            <i class="fas fa-fire text-2xl opacity-75"></i>
                        </div>
                    </div>

                    <!-- Fogyáshoz javasolt -->
                    <div class="bg-gradient-to-br from-pink-500 to-red-500 p-4 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-light">Fogyáshoz javasolt</p>
                                <p class="text-xl font-bold mt-1" id="lossResult">-</p>
                            </div>
                            <i class="fas fa-arrow-down text-2xl opacity-75"></i>
                        </div>
                    </div>

                    <!-- Tömegnöveléshez javasolt -->
                    <div class="bg-gradient-to-br from-green-600 to-emerald-600 p-4 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-light">Tömegnöveléshez javasolt</p>
                                <p class="text-xl font-bold mt-1" id="gainResult">-</p>
                            </div>
                            <i class="fas fa-arrow-up text-2xl opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function calculateCalories() {
                const gender = document.querySelector('input[name="gender"]:checked')?.value;
                const age = parseInt(document.getElementById('ageInput').value);
                const weight = parseFloat(document.getElementById('weightInput').value);
                const height = parseFloat(document.getElementById('heightInput').value);
                const activity = parseFloat(document.querySelector('input[name="activity"]:checked').value);

                if (!gender || !age || !weight || !height || !activity) {
                    alert('Kérlek tölts ki minden mezőt!');
                    return;
                }

                // Mifflin-St Jeor formula
                let bmr;
                if (gender === 'male') {
                    bmr = 10 * weight + 6.25 * height - 5 * age + 5;
                } else {
                    bmr = 10 * weight + 6.25 * height - 5 * age - 161;
                }

                const tdee = bmr * activity;

                const lossCalories = tdee - 500;
                const gainCalories = tdee + 500;

                document.getElementById('maintenanceResult').innerText = `${tdee.toFixed(1)} kcal/nap`;
                document.getElementById('lossResult').innerText = `${lossCalories.toFixed(1)} kcal/nap`;
                document.getElementById('gainResult').innerText = `${gainCalories.toFixed(1)} kcal/nap`;

                document.getElementById('resultsSection').classList.remove('hidden');
            }
        </script>
    </body>
@endsection

</html>
