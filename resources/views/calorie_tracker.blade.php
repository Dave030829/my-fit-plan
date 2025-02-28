<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Kalória Nyilvántartó</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-50 to-indigo-50 min-h-screen py-6 text-sm md:text-base">
        <div class="max-w-7xl mx-auto px-4 mt-10">
            <div class="text-center mb-12">
                <h1
                    class="text-2xl md:text-4xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    <i class="fas fa-fire mr-4"></i>Kalória Nyilvántartó
                </h1>
                <p class="text-xs md:text-base text-gray-600 mt-3">Kövesd az étrended és érd el a céljaid!</p>
            </div>

            <!-- Sikeres üzenet -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-3 md:p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <p class="text-xs md:text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Új étel hozzáadása -->
            <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-2xl p-5 md:p-8 mb-8">
                <h2 class="text-xl md:text-2xl font-bold text-purple-600 mb-4 md:mb-6 flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>Egyedi étel hozzáadása
                </h2>
                <form method="POST" action="{{ route('foods.store') }}" class="space-y-4 md:space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Étel neve -->
                        <div class="relative">
                            <i class="fas fa-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="name" required placeholder="Étel neve"
                                class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                        </div>

                        <!-- Kalória és Fehérje -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i class="fas fa-burn absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" name="kcal" required placeholder="Kalória"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                            </div>
                            <div class="relative">
                                <i
                                    class="fas fa-weight-hanging absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="protein" required placeholder="Fehérje (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                            </div>
                        </div>

                        <!-- Zsír és Szénhidrát -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i
                                    class="fas fa-oil-can absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="fat" required placeholder="Zsír (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                            </div>
                            <div class="relative">
                                <i
                                    class="fas fa-bread-slice absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" step="0.1" name="carbs" required placeholder="Szénhidrát (g)"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                            </div>
                        </div>

                        <!-- Mennyiség és egység -->
                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="relative">
                                <i
                                    class="fas fa-balance-scale absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="number" name="quantity" required placeholder="Mennyiség"
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                            </div>
                            <div class="relative">
                                <i
                                    class="fas fa-ruler-combined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select name="unit" required
                                    class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 appearance-none transition-all">
                                    <option value="db">darab</option>
                                    <option value="g">gramm (g)</option>
                                    <option value="ml">milliliter (ml)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-3 md:py-4 px-8 rounded-xl shadow-2xl transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-sm md:text-base">
                        <i class="fas fa-plus-circle mr-2"></i>Hozzáadás
                    </button>
                </form>
            </div>

            <!-- Asztali nézet -->
            <div class="hidden md:block bg-gray-100 p-3 md:p-4 rounded-xl shadow-lg">
                <div class="flex items-center mb-4 md:mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-purple-600 flex items-center">
                        <i class="fas fa-list-ul mr-2 bg-purple-100 p-2 rounded-xl"></i>
                        Napi étel lista
                    </h2>
                    <div class="ml-auto">
                        <button onclick="openFoodModal()"
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl text-xs md:text-base">
                            <i class="fas fa-plus mr-2"></i>Új étel
                        </button>
                    </div>
                </div>
                <!-- Dátum navigáció -->
                <div class="flex items-center justify-center mb-3 md:mb-4 bg-gray-200 rounded-xl p-2">
                    <button onclick="prevDate()" class="p-2 rounded-lg bg-white hover:bg-purple-100 transition-colors">
                        <i class="fas fa-chevron-left text-purple-600 text-lg"></i>
                    </button>
                    <div id="dateDisplay"
                        class="mx-3 md:mx-4 text-lg md:text-xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    </div>
                    <button onclick="nextDate()" class="p-2 rounded-lg bg-white hover:bg-purple-100 transition-colors">
                        <i class="fas fa-chevron-right text-purple-600 text-lg"></i>
                    </button>
                </div>
                <!-- Kiválasztott ételek -->
                <div class="overflow-x-auto rounded-xl border-2 border-gray-200 text-xs md:text-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-purple-600 to-indigo-600">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Név</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Mennyiség</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Kcal</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Fehérje</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase">Zsír</th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase bg-orange-700">Szénhidrát
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-white uppercase"></th>
                            </tr>
                        </thead>
                        <tbody id="selectedFoodsBody" class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Telefonos nézet -->
            <div class="block md:hidden bg-gray-100 p-3 md:p-4 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-3 md:mb-4">
                    <h2 class="text-base md:text-xl font-bold text-purple-600 flex items-center">
                        <i class="fas fa-list-ul bg-purple-100 p-2 rounded-xl mr-2"></i>
                        Napi étel lista
                    </h2>
                    <button onclick="openFoodModal()"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all text-xs">
                        <i class="fas fa-plus mr-2"></i>Új étel
                    </button>
                </div>
                <!-- MTelefonos nézet dátum navigáció -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <button onclick="prevDate()" class="p-2 rounded bg-white hover:bg-purple-100 transition-colors">
                        <i class="fas fa-chevron-left text-purple-600"></i>
                    </button>
                    <div id="dateDisplayMobile" class="mx-3 text-base md:text-lg font-bold text-purple-600">
                    </div>
                    <button onclick="nextDate()" class="p-2 rounded bg-white hover:bg-purple-100 transition-colors">
                        <i class="fas fa-chevron-right text-purple-600"></i>
                    </button>
                </div>
                <div id="selectedFoodsCards" class="space-y-4">
                </div>
            </div>

            <!-- Összegzés card-->
            <div
                class="mt-6 md:mt-8 grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 bg-gray-200 p-3 md:p-4 rounded-xl shadow-lg mb-5 text-xs md:text-base">
                <div class="bg-gradient-to-br from-purple-600 to-indigo-600 p-3 md:p-4 rounded-xl text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-light">Összes kalória</p>
                            <p class="text-lg md:text-2xl font-bold mt-1" id="totalKcal">0 kcal</p>
                        </div>
                        <i class="fas fa-fire text-xl md:text-2xl opacity-75"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-600 to-emerald-600 p-3 md:p-4 rounded-xl text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-light">Fehérje</p>
                            <p class="text-lg md:text-2xl font-bold mt-1" id="totalProtein">0 g</p>
                        </div>
                        <i class="fas fa-dumbbell text-xl md:text-2xl opacity-75"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-cyan-600 p-3 md:p-4 rounded-xl text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-light">Zsír</p>
                            <p class="text-lg md:text-2xl font-bold mt-1" id="totalFat">0 g</p>
                        </div>
                        <i class="fas fa-oil-can text-xl md:text-2xl opacity-75"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-300 to-amber-600 p-3 md:p-4 rounded-xl text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-light">Szénhidrát</p>
                            <p class="text-lg md:text-2xl font-bold mt-1" id="totalCarbs">0 g</p>
                        </div>
                        <i class="fas fa-bread-slice text-xl md:text-2xl opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Food Search Modal -->
        <div id="foodModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-5 text-sm md:text-base">
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 w-full max-w-md relative">
                <button class="absolute top-2 left-2 text-gray-600 hover:text-gray-800" onclick="closeFoodModal()">
                    <i class="fas fa-times text-lg"></i>
                </button>
                <h3 class="text-lg md:text-xl font-semibold mb-3 md:mb-4 text-center">Étel keresése</h3>
                <div class="relative mb-3 md:mb-4">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="modalFoodSearch" oninput="handleFoodSearch()"
                        class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                        placeholder="Kezdj el gépelni...">
                </div>
                <ul id="searchResults" class="border-t border-gray-200 pt-2 max-h-60 overflow-auto">
                </ul>
            </div>
        </div>

        <!-- Edit Quantity Modal -->
        <div id="editModal"
            class="fixed inset-0 hidden items-center justify-center p-5 bg-black bg-opacity-50 z-50 text-sm md:text-base">
            <div
                class="bg-white backdrop-blur-sm p-5 md:p-8 rounded-2xl shadow-2xl w-full max-w-sm relative transform transition-all duration-300">
                <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 transition-colors"
                    onclick="closeEditModal()">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h2
                    class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    <i class="fas fa-edit mr-2"></i>Mennyiség módosítása
                </h2>
                <div class="mb-4 md:mb-6">
                    <label for="editQuantityInput" class="block mb-1 md:mb-2 font-semibold text-gray-700">Új
                        mennyiség:</label>
                    <div class="relative">
                        <i
                            class="fas fa-balance-scale absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input id="editQuantityInput" type="number" min="1"
                            class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                            placeholder="Mennyiség">
                    </div>
                </div>
                <div class="mb-4 md:mb-6">
                    <label for="editUnitSelect" class="block mb-1 md:mb-2 font-semibold text-gray-700">Egység:</label>
                    <div class="relative">
                        <i
                            class="fas fa-ruler-combined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select id="editUnitSelect"
                            class="w-full pl-10 pr-3 md:pr-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 appearance-none transition-all">
                            <option value="db">darab</option>
                            <option value="g">gramm (g)</option>
                            <option value="ml">milliliter (ml)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl text-xs md:text-base"
                        onclick="saveEditQuantity()">
                        <i class="fas fa-save mr-2"></i>Mentés
                    </button>
                </div>
            </div>
        </div>

        <script>
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
                        searchResults.innerHTML = '<li class="px-3 py-2 text-gray-500">Nincs találat.</li>';
                        return;
                    }
                    let html = '';
                    data.forEach(food => {
                        const foodStr = encodeURIComponent(JSON.stringify(food));
                        html += `
      <li class="cursor-pointer px-3 py-2 hover:bg-purple-50 transition-colors"
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
      <tr class="hover:bg-gray-50 transition-colors">
      <td class="px-6 py-3 text-gray-900">${food.name}</td>
      <td class="px-6 py-3 text-gray-600">
      <div class="flex items-center">
      <span>${food.quantity} ${food.unit}</span>
      <button class="text-blue-600 px-3 py-1 rounded-lg"
      onclick="openEditModal(${food.id}, ${food.quantity}, '${food.unit}')">
      <i class="fas fa-edit mr-1"></i>
      </button>
      </div>
      </td>
      <td class="px-6 py-3 font-semibold text-purple-600">${food.kcal ?? 'n.a.'} kcal</td>
      <td class="px-6 py-3 text-gray-600">${food.protein ?? 'n.a.'} g</td>
      <td class="px-6 py-3 text-gray-600">${food.fat ?? 'n.a.'} g</td>
      <td class="px-6 py-3 text-gray-600">${food.carbs ?? 'n.a.'} g</td>
      <td class="px-6 py-3">
      <button class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-lg transition-colors"
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
      <div class="bg-gray-50 p-3 rounded-xl shadow hover:shadow-md transition-all">
      <div class="flex justify-between items-center mb-2">
      <h3 class="text-base font-semibold text-gray-800">${food.name}</h3>
      <button class="text-red-600 hover:text-red-800" onclick="removeFood(${food.id})">
      <i class="fas fa-trash"></i>
      </button>
      </div>
      <div class="text-xs md:text-sm text-gray-600 mb-2">
      Mennyiség: ${food.quantity} ${food.unit}
      </div>
      <div class="flex flex-wrap gap-2 text-xs md:text-sm">
      <span class="text-purple-600 font-semibold">${food.kcal ?? 'n.a.'} kcal</span>
      <span class="text-green-600 font-semibold">${food.protein ?? 'n.a.'} g fehérje</span>
      <span class="text-blue-600 font-semibold">${food.fat ?? 'n.a.'} g zsír</span>
      <span class="text-orange-600 font-semibold">${food.carbs ?? 'n.a.'} g szénhidrát</span>
      </div>
      <div class="flex justify-end mt-2">
      <button class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs md:text-sm" 
      onclick="openEditModal(${food.id}, ${food.quantity}, '${food.unit}')">
      <i class="fas fa-edit mr-1"></i>Edit
      </button>
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
                totalKcal.textContent = `${totals.kcal.toFixed(1)} kcal`;
                totalProtein.textContent = `${totals.protein.toFixed(1)} g`;
                totalFat.textContent = `${totals.fat.toFixed(1)} g`;
                totalCarbs.textContent = `${totals.carbs.toFixed(1)} g`;
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
        </script>
    </body>
@endsection

</html>
