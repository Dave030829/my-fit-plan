@extends('layouts.app')
@section('content')

    <body
        class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 min-h-screen py-6 text-sm md:text-base">
        @include('partials.flash-messages')
        <div class="max-w-7xl mx-auto px-4 mt-10">
            <div class="text-center mb-12">
                <h1
                    class="text-2xl md:text-4xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent">
                    <i class="fas fa-fire mr-4"></i>Kalória Nyilvántartó
                </h1>
                <p class="text-xs md:text-base text-gray-600 dark:text-gray-300 mt-3">
                    Kövesd az étrended és érd el a céljaid!
                </p>
            </div>

            <!-- Új étel hozzáadása -->
            <div
                class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm shadow-2xl rounded-2xl p-5 md:p-8 mb-8 dark:text-gray-100">
                <h2 class="text-xl md:text-2xl font-bold text-purple-600 dark:text-teal-400 mb-4 md:mb-6 flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>Egyedi étel hozzáadása
                </h2>
                <form method="POST" action="{{ route('foods.store') }}" class="space-y-4 md:space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Étel neve -->
                        <div class="relative">
                            <i class="fas fa-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="name" required placeholder="Étel neve"
                                class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                        </div>

                        <!-- Kalória és Fehérje -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i class="fas fa-burn absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" name="kcal" required placeholder="Kalória"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                            </div>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-fish absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="protein" required placeholder="Fehérje (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                            </div>
                        </div>

                        <!-- Zsír és Szénhidrát -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i
                                    class="fa-solid fa-droplet absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="fat" required placeholder="Zsír (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                            </div>
                            <div class="relative">
                                <i
                                    class="fas fa-bread-slice absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="carbs" required placeholder="Szénhidrát (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                            </div>
                        </div>

                        <!-- Mennyiség és egység -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i
                                    class="fas fa-balance-scale absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" name="quantity" required placeholder="Mennyiség"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all">
                            </div>
                            <div class="relative dark:text-gray-100">
                                <i
                                    class="fas fa-ruler-combined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select name="unit" required
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 appearance-none transition-all">
                                    <option value="db">darab</option>
                                    <option value="g">gramm (g)</option>
                                    <option value="ml">milliliter (ml)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 dark:bg-gradient-to-r dark:from-teal-600 dark:to-blue-600 hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 text-white font-bold py-3 md:py-4 px-8 rounded-xl shadow-2xl transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-sm md:text-base">
                        <i class="fas fa-plus-circle mr-2"></i>Hozzáadás
                    </button>
                </form>
            </div>

            <!-- Asztali nézet -->
            <div class="hidden md:block bg-gray-100 dark:bg-gray-800 p-3 md:p-4 rounded-xl shadow-lg">
                <div class="flex items-center mb-4 md:mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-purple-600 dark:text-teal-400 flex items-center">
                        <i class="fas fa-list-ul mr-2 bg-purple-100 dark:bg-gray-700 p-2 rounded-xl"></i>
                        Napi étel lista
                    </h2>
                    <div class="ml-auto">
                        <button onclick="openFoodModal()"
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:bg-gradient-to-r dark:from-teal-600 dark:to-blue-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl text-xs md:text-base">
                            <i class="fas fa-plus mr-2"></i>Új étel
                        </button>
                    </div>
                </div>
                <!-- Dátum navigáció -->
                <div class="flex items-center justify-center mb-3 md:mb-4 bg-gray-200 dark:bg-gray-700 rounded-xl p-2">
                    <button onclick="prevDate()"
                        class="p-2 rounded-lg bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-left text-purple-600 dark:text-teal-400 text-lg"></i>
                    </button>
                    <div id="dateDisplay"
                        class="mx-3 md:mx-4 text-lg md:text-xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 dark:bg-gradient-to-r dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent">
                    </div>
                    <button onclick="nextDate()"
                        class="p-2 rounded-lg bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-right text-purple-600 dark:text-teal-400 text-lg"></i>
                    </button>
                </div>
                <!-- Kiválasztott ételek -->
                <div class="overflow-x-auto rounded-xl border-2 border-gray-200 dark:border-gray-700 text-xs md:text-sm">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:bg-gradient-to-r dark:from-teal-400 dark:to-blue-400">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Név</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Mennyiség</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Kcal</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Fehérje</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Zsír</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Szénhidrát
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase"></th>
                            </tr>
                        </thead>
                        <tbody id="selectedFoodsBody"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Telefonos nézet -->
            <div class="block md:hidden bg-gray-100 dark:bg-gray-800 p-3 md:p-4 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-3 md:mb-4">
                    <h2 class="text-base md:text-xl font-bold text-purple-600 dark:text-teal-400 flex items-center">
                        <i class="fas fa-list-ul bg-purple-100 dark:bg-gray-700 p-2 rounded-xl mr-2"></i>
                        Napi étel lista
                    </h2>
                    <button onclick="openFoodModal()"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:bg-gradient-to-r dark:from-teal-600 dark:to-blue-600 text-white px-6 py-2 rounded-xl hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 transition-all text-xs">
                        <i class="fas fa-plus mr-2"></i>Új étel
                    </button>
                </div>
                <!-- Telefonos nézet dátum navigáció -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <button onclick="prevDate()"
                        class="p-2 rounded bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-left text-purple-600 dark:text-teal-400"></i>
                    </button>
                    <div id="dateDisplayMobile"
                        class="mx-3 text-base md:text-lg font-bold text-purple-600 dark:text-teal-400">
                    </div>
                    <button onclick="nextDate()"
                        class="p-2 rounded bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-right text-purple-600 dark:text-teal-400"></i>
                    </button>
                </div>
                <div id="selectedFoodsCards" class="space-y-4">
                </div>
            </div>

            <!-- Összegzés card -->
            <div
                class="mt-6 md:mt-8 bg-white dark:bg-gray-800 p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-5 w-full max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row gap-6 items-stretch">
                    <!-- Progress Ring -->
                    <div class="md:w-1/3 flex flex-col items-center p-4 bg-indigo-50 dark:bg-gray-800 rounded-xl">
                        <div class="relative w-36 h-36 mb-4">
                            <svg viewBox="0 0 100 100" class="transform -rotate-90 w-full h-full">
                                <!-- Háttér kör -->
                                <circle cx="50" cy="50" r="45" stroke="currentColor" class="text-gray-200"
                                    stroke-width="8" fill="none" />
                                <!-- Progress kör -->
                                <circle id="calorieRing" cx="50" cy="50" r="45" stroke="currentColor"
                                    class="text-indigo-500" stroke-width="8" stroke-linecap="round" fill="none"
                                    stroke-dasharray="283" stroke-dashoffset="283" />
                            </svg>
                            <!-- Középső felirat -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <p class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-300"
                                    id="totalKcalRing">0</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">kcal</p>
                            </div>
                        </div>
                        <div class="text-center bg-blue-200 dark:bg-blue-800 p-2 px-10 rounded-xl">
                            <h3 class="font-semibold text-blue-700 dark:text-blue-400 mb-1">Kalória limit</h3>
                            <p class="text-md text-blue-500 dark:text-blue-400">{{ Auth::user()->calorie_goal }} kcal</p>
                        </div>
                    </div>

                    <div class="md:w-2/3 flex flex-col gap-4">
                        <!-- Protein Card -->
                        <div
                            class="bg-gradient-to-br from-red-500 to-red-300 dark:from-red-800 dark:to-red-600 p-4 rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-white mb-1">Fehérje</p>
                                    <p class="text-xl font-bold text-white" id="totalProtein">0 g</p>
                                </div>
                                <div
                                    class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                    <i class="fas fa-fish text-red-700 dark:text-red-300"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Fat Card -->
                        <div
                            class="bg-gradient-to-br from-yellow-500 to-yellow-300 dark:from-yellow-700 dark:to-yellow-500 p-4 rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-white mb-1">Zsír</p>
                                    <p class="text-xl font-bold text-white" id="totalFat">0 g</p>
                                </div>
                                <div
                                    class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-droplet text-yellow-700 dark:text-yellow-300"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Carbs Card -->
                        <div
                            class="bg-gradient-to-br from-blue-500 to-blue-300 dark:from-blue-800 dark:to-blue-600 p-4 rounded-xl shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-white mb-1">Szénhidrát</p>
                                    <p class="text-xl font-bold text-white" id="totalCarbs">0 g</p>
                                </div>
                                <div
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bread-slice text-blue-700 dark:text-blue-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Food Search Modal -->
            <div id="foodModal"
                class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden items-center justify-center p-5 text-sm md:text-base">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 md:p-6 w-full max-w-md relative">
                    <button
                        class="absolute top-2 left-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100"
                        onclick="closeFoodModal()">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                    <h3 class="text-lg md:text-xl font-semibold mb-3 md:mb-4 text-center dark:text-gray-300">
                        Étel keresése
                    </h3>
                    <div class="relative mb-3 md:mb-4">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="modalFoodSearch" oninput="handleFoodSearch()"
                            class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-purple-500 dark:focus:border-teal-500 focus:ring-2 focus:ring-purple-200 dark:focus:ring-teal-200 dark:bg-gray-900 transition-all dark:text-gray-300"
                            placeholder="Kezdj el gépelni...">
                    </div>
                    <ul id="searchResults"
                        class="border-t border-gray-200 dark:border-gray-700 pt-2 max-h-60 overflow-auto dark:text-gray-300">
                    </ul>
                </div>
            </div>

            <style>
                #calorieRing {
                    transition: stroke-dashoffset 0.6s ease;
                }
            </style>

            <script>
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
                    } else if (ratio >= 0.7 && ratio < 0.95) {
                        ring.style.stroke = "#FBBF24";
                    } else {
                        ring.style.stroke = "#EF4444";
                    }

                    document.getElementById('totalKcalRing').textContent = current.toFixed(1);
                }

                let selectedFoods = [];
                let currentFoodDiaryId = null;
                const selectedFoodsBody = document.getElementById('selectedFoodsBody');
                const selectedFoodsCards = document.getElementById('selectedFoodsCards');
                const foodModal = document.getElementById('foodModal');
                const searchInput = document.getElementById('modalFoodSearch');
                const searchResults = document.getElementById('searchResults');
                const totalKcal = document.getElementById('totalKcal');
                const totalProtein = document.getElementById('totalProtein');
                const totalFat = document.getElementById('totalFat');
                const totalCarbs = document.getElementById('totalCarbs');
                const dateDisplay = document.getElementById('dateDisplay');
                const dateDisplayMobile = document.getElementById('dateDisplayMobile');

                let selectedDate = new Date();

                document.addEventListener('DOMContentLoaded', () => {
                    updateDateDisplay();
                    loadFoodDiary();
                });

                function openFoodModal() {
                    foodModal.classList.remove('hidden');
                    foodModal.classList.add('flex');
                    searchInput.focus();
                }

                function closeFoodModal() {
                    foodModal.classList.add('hidden');
                    foodModal.classList.remove('flex');
                    searchInput.value = '';
                    searchResults.innerHTML = '';
                }

                async function loadFoodDiary() {
                    try {
                        const year = selectedDate.getFullYear();
                        const month = ('0' + (selectedDate.getMonth() + 1)).slice(-2);
                        const day = ('0' + selectedDate.getDate()).slice(-2);
                        const dateStr = `${year}-${month}-${day}`;

                        const resp = await fetch("{{ route('foodDiary.index') }}?day=" + dateStr);
                        const data = await resp.json();
                        selectedFoods = data;
                        renderSelectedFoods();
                        updateSummary();
                    } catch (error) {
                        console.error(error);
                    }
                }

                async function handleFoodSearch() {
                    const query = searchInput.value.trim();
                    if (!query) {
                        searchResults.innerHTML = '';
                        return;
                    }
                    try {
                        const response = await fetch("{{ route('foods.search') }}?term=" + encodeURIComponent(query));
                        const data = await response.json();
                        if (!data.length) {
                            searchResults.innerHTML =
                                '<li class="px-3 py-2 text-gray-500 dark:text-gray-300">Nincs találat.</li>';
                            return;
                        }
                        let html = '';
                        data.forEach(food => {
                            const foodStr = encodeURIComponent(JSON.stringify(food));
                            html += `
      <li class="cursor-pointer px-3 py-2 hover:bg-purple-50 dark:hover:bg-gray-700 transition-colors"
      onclick="addFoodToSelected('${foodStr}')">
      <strong>${food.name}</strong> - ${food.kcal} kcal, ${food.protein} g fehérje, ${food.fat} g zsír, ${food.carbs} g szénhidrát (<em>${food.unit}</em>)
      </li>
      `;
                        });
                        searchResults.innerHTML = html;
                    } catch (error) {
                        console.error(error);
                        searchResults.innerHTML = '<li class="px-3 py-2 text-red-500">Hiba történt a keresés során.</li>';
                    }
                }

                async function addFoodToSelected(foodStr) {
                    const food = JSON.parse(decodeURIComponent(foodStr));
                    const year = selectedDate.getFullYear();
                    const month = ('0' + (selectedDate.getMonth() + 1)).slice(-2);
                    const day = ('0' + selectedDate.getDate()).slice(-2);
                    const dateStr = `${year}-${month}-${day}`;
                    try {
                        const postData = {
                            food_id: food.id,
                            quantity: food.quantity,
                            unit: food.unit,
                            day: dateStr
                        };
                        const resp = await fetch("{{ route('foodDiary.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(postData),
                        });
                        if (!resp.ok) {
                            throw new Error('Hiba a szerveren: ' + resp.status);
                        }
                        await loadFoodDiary();
                        closeFoodModal();
                    } catch (error) {
                        console.error(error);
                        alert('Nem sikerült elmenteni az ételt!');
                    }
                }

                async function removeFood(recordId) {
                    try {
                        const resp = await fetch("/food-diary/" + recordId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        });
                        if (!resp.ok) throw new Error('Hiba törlés közben: ' + resp.status);
                        await loadFoodDiary();
                    } catch (error) {
                        console.error(error);
                        alert("Nem sikerült törölni az ételt!");
                    }
                }

                function renderSelectedFoods() {
                    if (selectedFoodsBody) {
                        let rows = '';
                        selectedFoods.forEach(food => {
                            rows += `
      <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
      <td class="px-6 py-3 text-gray-900 dark:text-gray-300">${food.name}</td>
      <td class="px-6 py-3 text-gray-600 dark:text-gray-400">
    <div class="flex items-center">
        <input type="number" min="1"
            class="bg-gray-50 border border-gray-300 rounded px-2 py-1 w-16 text-gray-800
                   dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
            value="${food.quantity}"
            onchange="updateFoodQuantity(${food.id}, this.value, '${food.unit}')"
        />
        <span class="ml-2">${food.unit}</span>
    </div>
</td>

      <td class="px-6 py-3 font-semibold text-purple-600 dark:text-teal-400">${food.kcal ?? 'n.a.'} kcal</td>
      <td class="px-6 py-3 text-gray-600 dark:text-gray-400">${food.protein ?? 'n.a.'} g</td>
      <td class="px-6 py-3 text-gray-600 dark:text-gray-400">${food.fat ?? 'n.a.'} g</td>
      <td class="px-6 py-3 text-gray-600 dark:text-gray-400">${food.carbs ?? 'n.a.'} g</td>
      <td class="px-6 py-3">
      <button class="bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 text-red-600 px-3 py-1 rounded-lg transition-colors"
      onclick="removeFood(${food.id})">
      <i class="fas fa-trash"></i>
      </button>
      </td>
      </tr>
      `;
                        });
                        selectedFoodsBody.innerHTML = rows;
                    }

                    if (selectedFoodsCards) {
                        let cardsHtml = '';
                        selectedFoods.forEach(food => {
                            cardsHtml += `
<div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-xl shadow hover:shadow-md transition-all">
    <!-- Felső sáv: Név és Törlés -->
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-base font-semibold text-gray-800 dark:text-gray-300">
            ${food.name}
        </h3>
        <button class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300"
                onclick="removeFood(${food.id})">
            <i class="fas fa-trash"></i>
        </button>
    </div>

    <!-- Mennyiség -->
    <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mb-2">
        Mennyiség:
        <input 
            type="number" 
            min="1"
            class="w-16 px-2 py-1 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 
                   rounded text-gray-800 dark:text-gray-100"
            value="${food.quantity}"
            onchange="updateFoodQuantity(${food.id}, this.value, '${food.unit}')"
        />
        <span class="ml-1">${food.unit}</span>
    </div>

    <!-- Makrók (ikonos) -->
    <link 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
      rel="stylesheet"
    />

    <div class="w-full flex gap-1 p-1 text-[10px] leading-tight rounded-2xl 
                bg-gray-100 dark:bg-gray-600">
      <!-- Kalória -->
      <div class="flex-1 rounded-xl flex flex-col items-center justify-center shadow-md p-2 
                  bg-amber-100 dark:bg-amber-700">
        <span class="font-semibold text-amber-900 dark:text-amber-100">
          ${food.kcal ?? 'n.a.'} kcal
        </span>
        <i class="fa-solid fa-fire 
                   text-amber-300 dark:text-amber-200
                   bg-amber-50 dark:bg-amber-800
                   p-2 text-sm mt-2 rounded-full shadow-inner">
        </i>
      </div>

      <!-- Fehérje -->
      <div class="flex-1 rounded-xl flex flex-col items-center justify-center shadow-md p-2
                  bg-red-100 dark:bg-red-700">
        <span class="font-semibold text-red-900 dark:text-red-100">
          ${food.protein ?? 'n.a.'} g
        </span>
        <i class="fa-solid fa-bacon
                   text-red-600 dark:text-red-200
                   bg-red-50 dark:bg-red-800
                   p-2 text-sm mt-2 rounded-full shadow-inner">
        </i>
      </div>

      <!-- Szénhidrát -->
      <div class="flex-1 rounded-xl flex flex-col items-center justify-center shadow-md p-2
                  bg-blue-100 dark:bg-blue-700">
        <span class="font-semibold text-blue-900 dark:text-blue-100">
          ${food.carbs ?? 'n.a.'} g
        </span>
        <i class="fa-solid fa-bread-slice
                   text-blue-600 dark:text-blue-200
                   bg-blue-50 dark:bg-blue-800
                   p-2 text-sm mt-2 rounded-full shadow-inner">
        </i>
      </div>

      <!-- Zsír -->
      <div class="flex-1 rounded-xl flex flex-col items-center justify-center shadow-md p-2
                  bg-yellow-100 dark:bg-yellow-700">
        <span class="font-semibold text-yellow-900 dark:text-yellow-100">
          ${food.fat ?? 'n.a.'} g
        </span>
        <i class="fa-solid fa-droplet
                   text-yellow-600 dark:text-yellow-200
                   bg-yellow-50 dark:bg-yellow-800
                   p-2 text-sm mt-2 rounded-full shadow-inner">
        </i>
      </div>
    </div>
</div>

            `;
                        });
                        selectedFoodsCards.innerHTML = cardsHtml;
                    }

                    updateSummary();
                }

                function openEditModal(foodDiaryId, oldQty, oldUnit) {
                    currentFoodDiaryId = foodDiaryId;
                    document.getElementById('editQuantityInput').value = oldQty;
                    document.getElementById('editUnitSelect').value = oldUnit;
                    const modal = document.getElementById('editModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeEditModal() {
                    const modal = document.getElementById('editModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                async function saveEditQuantity() {
                    const newQty = document.getElementById('editQuantityInput').value;
                    const newUnit = document.getElementById('editUnitSelect').value;
                    if (!newQty) {
                        alert('Kérlek adj meg egy mennyiséget!');
                        return;
                    }
                    try {
                        const response = await fetch(`/food-diary/${currentFoodDiaryId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                quantity: newQty,
                                unit: newUnit
                            })
                        });
                        if (!response.ok) {
                            throw new Error('Hiba frissítés közben. Kód: ' + response.status);
                        }
                        await loadFoodDiary();
                        closeEditModal();
                    } catch (error) {
                        console.error(error);
                        alert('Nem sikerült a mennyiséget módosítani!');
                    }
                }

                function updateSummary() {
                    // Összegzés a selectedFoods tömb alapján
                    const totals = selectedFoods.reduce((acc, food) => ({
                        kcal: acc.kcal + (parseFloat(food.kcal) || 0),
                        protein: acc.protein + (parseFloat(food.protein) || 0),
                        fat: acc.fat + (parseFloat(food.fat) || 0),
                        carbs: acc.carbs + (parseFloat(food.carbs) || 0)
                    }), {
                        kcal: 0,
                        protein: 0,
                        fat: 0,
                        carbs: 0
                    });

                    totalProtein.textContent = `${totals.protein.toFixed(1)} g`;
                    totalFat.textContent = `${totals.fat.toFixed(1)} g`;
                    totalCarbs.textContent = `${totals.carbs.toFixed(1)} g`;

                    const userGoal = parseFloat("{{ Auth::user()->calorie_goal ?? 0 }}");

                    updateProgress(totals.kcal, userGoal);

                    // Mentés localStorage-be, hogy a profil oldalon is elérhető legyen
                    localStorage.setItem('dailySummary', JSON.stringify(totals));
                }

                function updateDateDisplay() {
                    const year = selectedDate.getFullYear();
                    const month = ('0' + (selectedDate.getMonth() + 1)).slice(-2);
                    const day = ('0' + selectedDate.getDate()).slice(-2);
                    const weekday = selectedDate.toLocaleDateString('hu-HU', {
                        weekday: 'long'
                    });
                    if (dateDisplay) dateDisplay.innerText = `${year}-${month}-${day} - ${weekday}`;
                    if (dateDisplayMobile) dateDisplayMobile.innerText = `${year}-${month}-${day} - ${weekday}`;
                    loadFoodDiary();
                }

                function prevDate() {
                    const current = new Date();
                    const sevenDaysBefore = new Date(current);
                    sevenDaysBefore.setDate(current.getDate() - 7);
                    if (selectedDate > sevenDaysBefore) {
                        selectedDate.setDate(selectedDate.getDate() - 1);
                        updateDateDisplay();
                    }
                }

                function nextDate() {
                    const current = new Date();
                    const sevenDaysAfter = new Date(current);
                    sevenDaysAfter.setDate(current.getDate() + 7);
                    if (selectedDate < sevenDaysAfter) {
                        selectedDate.setDate(selectedDate.getDate() + 1);
                        updateDateDisplay();
                    }
                }

                async function updateFoodQuantity(foodDiaryId, newQty, unit) {
                    try {
                        const response = await fetch(`/food-diary/${foodDiaryId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                quantity: newQty,
                                unit: unit
                            })
                        });
                        if (!response.ok) {
                            throw new Error('Hiba frissítés közben. Kód: ' + response.status);
                        }
                        await loadFoodDiary();
                    } catch (error) {
                        console.error(error);
                        alert('Nem sikerült a mennyiséget módosítani!');
                    }
                }
            </script>
            @yield('content')
    </body>
@endsection
