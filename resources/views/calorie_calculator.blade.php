@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 min-h-screen py-10">
        @include('partials.flash-messages')

        <div class="max-w-xl mx-auto bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl mt-5 mb-5">
            <div class="text-center mb-8">
                <h1
                    class="text-4xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent inline-block mb-2">
                    <i class="fas fa-calculator mr-2"></i>Kalória Kalkulátor
                </h1>
                <p class="text-gray-700 dark:text-gray-300 py-3">
                    Számold ki a napi kalóriaszükségleted a céljaidnak megfelelően!
                </p>
            </div>

            @php
                $defaultAge = Auth::check() ? Auth::user()->age : '';
                $defaultGender = Auth::check() ? Auth::user()->gender : '';
                $defaultWeight = Auth::check() ? Auth::user()->weight : '';
                $defaultHeight = Auth::check() ? Auth::user()->height : '';
            @endphp

            <div class="space-y-6">
                <!-- Nem (Gender) -->
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    <li>
                        <input type="radio" id="male" name="gender" value="male" class="hidden peer" required
                            {{ $defaultGender == 'male' ? 'checked' : '' }} />
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
                            {{ $defaultGender == 'female' ? 'checked' : '' }} />
                        <label for="female"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white border border-gray-200 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 dark:hover:text-gray-300 dark:hover:bg-gray-700 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Nő</div>
                            </div>
                            <i class="fa-solid fa-venus"></i>
                        </label>
                    </li>
                </ul>

                <!-- Életkor (Age) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300" for="ageInput">
                        Életkor (év):
                    </label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="ageInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 transition-all bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300"
                            placeholder="Pl. 30" value="{{ $defaultAge }}" />
                    </div>
                </div>

                <!-- Testsúly (Weight) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300" for="weightInput">
                        Testsúly (kg):
                    </label>
                    <div class="relative">
                        <i
                            class="fas fa-weight-hanging absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="weightInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 transition-all bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300"
                            placeholder="Pl. 70" value="{{ $defaultWeight }}" />
                    </div>
                </div>

                <!-- Magasság (Height) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300" for="heightInput">
                        Magasság (cm):
                    </label>
                    <div class="relative">
                        <i
                            class="fas fa-ruler-combined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="number" id="heightInput"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 transition-all bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300"
                            placeholder="Pl. 175" value="{{ $defaultHeight }}" />
                    </div>
                </div>

                <!-- Aktivitási szint -->
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-2">Aktivitási szint:</label>
                    <div class="space-y-2 p-1">
                        <div>
                            <input type="radio" id="activity-1.2" name="activity" value="1.2" class="hidden peer"
                                checked>
                            <label for="activity-1.2"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700 transition-colors duration-200 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                <span>Ülő életmód (nagyon kevés mozgás)</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="activity-1.375" name="activity" value="1.375" class="hidden peer">
                            <label for="activity-1.375"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700 transition-colors duration-200 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                <span>Kicsit aktív (heti 1-3 edzés)</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="activity-1.55" name="activity" value="1.55" class="hidden peer">
                            <label for="activity-1.55"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700 transition-colors duration-200 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                <span>Közepesen aktív (heti 3-5 edzés)</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="activity-1.725" name="activity" value="1.725" class="hidden peer">
                            <label for="activity-1.725"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700 transition-colors duration-200 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                <span>Nagyon aktív (heti 6-7 edzés)</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="activity-1.9" name="activity" value="1.9" class="hidden peer">
                            <label for="activity-1.9"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700 transition-colors duration-200 peer-checked:text-purple-600 dark:peer-checked:text-teal-100 peer-checked:border-purple-600 dark:peer-checked:border-teal-400">
                                <span>Szuper aktív (napi több edzés, fizikai munka)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Számolás gomb -->
                <div class="mt-6 text-center">
                    <button onclick="calculateCalories()"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-600 dark:to-blue-600 text-white px-8 py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center">
                        <i class="fas fa-calculator mr-2"></i>Számolás
                    </button>
                </div>
            </div>

            <!-- Eredmények -->
            <div id="resultsSection" class="mt-10 hidden">
                <h2 class="text-2xl font-bold text-purple-600 dark:text-teal-400 mb-4">Eredmények:</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Fenntartási kalória -->
                    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 dark:from-teal-600 dark:to-blue-600 p-4 rounded-xl text-white cursor-pointer"
                        onclick="saveGoal(parseFloat(document.getElementById('maintenanceResult').innerText))">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-light">Fenntartási kalória</p>
                                <p class="text-xl font-bold mt-1" id="maintenanceResult">-</p>
                            </div>
                            <i class="fas fa-fire text-2xl opacity-75"></i>
                        </div>
                    </div>

                    <!-- Fogyáshoz javasolt -->
                    <div class="bg-gradient-to-br from-pink-500 to-red-500 p-4 rounded-xl text-white cursor-pointer"
                        onclick="saveGoal(parseFloat(document.getElementById('lossResult').innerText))">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-light">Fogyáshoz javasolt</p>
                                <p class="text-xl font-bold mt-1" id="lossResult">-</p>
                            </div>
                            <i class="fas fa-arrow-down text-2xl opacity-75"></i>
                        </div>
                    </div>

                    <!-- Tömegnöveléshez javasolt -->
                    <div class="bg-gradient-to-br from-green-400 to-green-700 p-4 rounded-xl text-white cursor-pointer"
                        onclick="saveGoal(parseFloat(document.getElementById('gainResult').innerText))">
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
            function showFlashMessage(message, type) {
                const flashDiv = document.createElement('div');
                flashDiv.id = 'flashMessage';
                flashDiv.className =
                    'fixed top-10 left-1/2 w-full max-w-lg px-4 transform -translate-x-1/2 -translate-y-full transition-all duration-500 z-50';
                flashDiv.setAttribute('role', 'alert');
                flashDiv.setAttribute('aria-live', 'assertive');

                if (type === 'success') {
                    flashDiv.innerHTML = `
                        <div class="p-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 shadow-lg">
                            <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400"></i>
                            <span class="text-green-700 dark:text-green-300">` + message + `</span>
                        </div>
                    `;
                } else {
                    flashDiv.innerHTML = `
                        <div class="p-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-800 rounded-xl flex items-center gap-3 shadow-lg">
                            <i class="fa-solid fa-circle-exclamation text-red-600 dark:text-red-400"></i>
                            <span class="text-red-700 dark:text-red-300">` + message + `</span>
                        </div>
                    `;
                }

                document.body.appendChild(flashDiv);

                setTimeout(() => {
                    flashDiv.classList.remove('-translate-y-full');
                    flashDiv.classList.add('translate-y-0');
                }, 100);

                setTimeout(() => {
                    flashDiv.classList.remove('translate-y-0');
                    flashDiv.classList.add('-translate-y-full');
                }, 3100);

                setTimeout(() => {
                    flashDiv.remove();
                }, 3600);
            }

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

            function saveGoal(calorieValue) {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch("{{ route('profile.goal.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            calorie_goal: calorieValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showFlashMessage("Cél beállítva: " + calorieValue + " kcal/nap", "success");
                        } else {
                            showFlashMessage("Hiba történt a cél beállításakor!", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showFlashMessage("Hiba történt a cél beállításakor!", "error");
                    });
            }
        </script>
    </body>
@endsection
