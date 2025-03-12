@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-500 to-indigo-600 dark:from-gray-900 dark:to-gray-800 min-h-screen p-4">
        @include('partials.flash-messages')
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Bal oszlop (Profil szerkesztése) -->
            <div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full mt-5 mb-5 p-8">
                    <!-- Fejléc -->
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <i
                                class="fas fa-user-edit text-4xl bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent"></i>
                        </div>
                        <h1
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent">
                            Profil adatai
                        </h1>
                    </div>

                    <!-- Felhasználói infók -->
                    <div class="grid gap-4 mb-8">
                        <div
                            class="flex items-center bg-gray-50 dark:bg-gray-700 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <i class="fas fa-user text-purple-600 dark:text-teal-400 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Felhasználónév</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-100">{{ Auth::user()->username }}</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center bg-gray-50 dark:bg-gray-700 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <i class="fas fa-envelope text-blue-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Email cím</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-100">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center bg-gray-50 dark:bg-gray-700 p-4 rounded-lg transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <i class="fas fa-lock text-green-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Jelszó</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-100">••••••••</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profil Szerkesztő űrlap -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full mt-5 mb-5 p-8">
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <i
                                class="fas fa-user-edit text-4xl bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent"></i>
                        </div>
                        <h1
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent">
                            Profil szerkesztése
                        </h1>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Életkor slider -->
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Életkor:
                                <span class="text-purple-600 dark:text-teal-400 font-bold"
                                    id="ageValue">{{ Auth::user()->age ?? 25 }}</span>
                            </label>
                            <div class="relative">
                                <input type="range" name="age" id="age" min="10" max="90"
                                    value="{{ Auth::user()->age ?? 25 }}"
                                    class="w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-lg appearance-none cursor-pointer
                     [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-purple-600 dark:[&::-webkit-slider-thumb]:bg-teal-400 [&::-webkit-slider-thumb]:appearance-none hover:[&::-webkit-slider-thumb]:scale-125 transition-all"
                                    oninput="document.getElementById('ageValue').textContent = this.value">
                            </div>
                        </div>

                        <!-- Nem (Gender) radio gombok -->
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input type="radio" id="male" name="gender" value="male" class="hidden peer"
                                    required {{ (Auth::user()->gender ?? '') == 'male' ? 'checked' : '' }} />
                                <label for="male"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white border border-gray-200 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 dark:hover:text-gray-300 dark:hover:bg-gray-700 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Férfi</div>
                                    </div>
                                    <i class="fa-solid fa-mars"></i>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="female" name="gender" value="female" class="hidden peer"
                                    {{ (Auth::user()->gender ?? '') == 'female' ? 'checked' : '' }} />
                                <label for="female"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white border border-gray-200 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 dark:hover:text-gray-300 dark:hover:bg-gray-700 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Nő</div>
                                    </div>
                                    <i class="fa-solid fa-venus"></i>
                                </label>
                            </li>
                        </ul>

                        <!-- Súly input -->
                        <div class="group">
                            <label for="weight"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Súly (kg)</label>
                            <input type="number" name="weight" id="weight" min="0" max="300" step="1"
                                value="{{ Auth::user()->weight ?? '' }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 transition-all bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"
                                placeholder="pl. 70">
                        </div>

                        <!-- Magasság input -->
                        <div class="group">
                            <label for="height"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Magasság
                                (cm)</label>
                            <input type="number" name="height" id="height" min="50" max="250" step="1"
                                value="{{ Auth::user()->height ?? '' }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 transition-all bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"
                                placeholder="pl. 170">
                        </div>

                        <!-- Frissítés gomb -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-600 dark:to-blue-600 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-[1.02] active:scale-95">
                            Frissítés <i class="fas fa-sync-alt ml-2 animate-spin-on-hover"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Jobb oszlop (Napi összegzés) -->
            <div>
                <div class="bg-white dark:bg-gray-800 p-4 md:p-6 rounded-2xl shadow-2xl mb-5 mt-5 w-full mx-auto">
                    <div class="text-center mb-8 mt-5">
                        <i
                            class="fa-solid fa-list text-4xl bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent mb-2"></i>
                        <h2
                            class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent mb-5">
                            Napi összegzés</h2>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 items-stretch">
                        <!-- Progress Ring  -->
                        <div class="md:w-1/3 flex flex-col items-center p-4 bg-indigo-50 dark:bg-gray-700 rounded-xl">
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
                                    <p class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100"
                                        id="totalKcalRing">0</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">kcal</p>
                                </div>
                            </div>
                            <div class="text-center bg-blue-200 dark:bg-blue-800 p-2 px-10 rounded-xl">
                                <h3 class="font-semibold text-blue-700 dark:text-blue-400 mb-1">Kalória limit</h3>
                                <p class="text-md text-blue-500 dark:text-blue-400">{{ Auth::user()->calorie_goal }} kcal
                                </p>
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
            @yield('content')
    </body>
@endsection
