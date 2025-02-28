<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3 napos edzés</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-50 to-indigo-50 min-h-screen p-4 sm:p-6 text-sm md:text-base">
        <div class="max-w-7xl mx-auto mt-5">
            <!-- Főcímsor -->
            <h1
                class="text-2xl sm:text-5xl font-extrabold text-center mb-8 
                 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                <i class="fas fa-dumbbell mr-3"></i>Edzés Tervező
            </h1>

            <!-- Sikeres mentés üzenet -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-3 md:p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                        <p class="text-xs md:text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Hibák megjelenítése -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-3 md:p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex">
                        <i class="fas fa-times-circle text-red-500 mr-3 mt-1"></i>
                        <div>
                            @foreach ($errors->all() as $err)
                                <p class="text-xs md:text-sm text-red-700">{{ $err }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Container -->
            <form action="{{ route('workout.store') }}" method="POST" id="workoutForm"
                class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-2xl px-3 md:px-8 pt-6 md:pt-8 pb-14 md:pb-16 mb-4">
                @csrf

                <!-- 3 nap generálása -->
                @for ($dayIndex = 1; $dayIndex <= 3; $dayIndex++)
                    <!-- Nap fejléc -->
                    <div class="relative group mb-6 md:mb-8">
                        <div class="absolute group-hover:opacity-40 transition duration-1000"></div>
                        <div
                            class="relative bg-gradient-to-r from-purple-600 to-indigo-600 p-4 md:p-6 rounded-lg shadow-lg">
                            <h2 class="text-lg md:text-2xl font-bold text-white flex items-center">
                                <span class="bg-white/20 p-2 rounded-lg mr-3 md:mr-4">
                                    <i class="fas fa-calendar-day text-white"></i>
                                </span>
                                Nap #{{ $dayIndex }}
                            </h2>
                        </div>
                    </div>

                    <!-- Nap tartalma -->
                    <div class="mb-10 md:mb-12">
                        @php
                            $oldDayName = old("day_name.$dayIndex", $days[$dayIndex]['dayName'] ?? '');
                            $currentExerciseCount = $days[$dayIndex]['exerciseCount'] ?? $defaultExerciseCount;
                        @endphp

                        <!-- Nap neve -->
                        <div class="mb-4 md:mb-6">
                            <label for="day_name_{{ $dayIndex }}"
                                class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Nap neve:
                            </label>
                            <div class="relative">
                                <input type="text" name="day_name[{{ $dayIndex }}]" id="day_name_{{ $dayIndex }}"
                                    value="{{ $oldDayName }}"
                                    class="w-full px-3 md:px-4 py-2 md:py-3 border-2 border-gray-200 rounded-xl 
                                       focus:border-purple-500 focus:ring-2 focus:ring-purple-200 
                                       transition-all placeholder-gray-400 text-base">
                                <div class="absolute inset-y-0 right-3 flex items-center">
                                    <i class="fas fa-pencil-alt text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Gyakorlatok  -->
                        <div id="exercises_day_{{ $dayIndex }}" class="space-y-4 md:space-y-6">
                            @for ($exerciseIndex = 1; $exerciseIndex <= $currentExerciseCount; $exerciseIndex++)
                                @php
                                    $oldExerciseName = old(
                                        "exercise_name.$dayIndex.$exerciseIndex",
                                        $days[$dayIndex]['exercises'][$exerciseIndex]['name'] ?? '',
                                    );
                                    $currentSetCount =
                                        $days[$dayIndex]['exercises'][$exerciseIndex]['setCount'] ?? $defaultSetCount;
                                    if (old("exercise_{$dayIndex}_{$exerciseIndex}_sets")) {
                                        $currentSetCount = count(old("exercise_{$dayIndex}_{$exerciseIndex}_sets"));
                                    }
                                @endphp

                                <!-- Egyetlen gyakorlat -->
                                <div class="exercise-block bg-gray-50 p-3 md:p-6 rounded-xl border-2 border-dashed border-gray-200 hover:border-purple-200 transition-all"
                                    data-exercise-index="{{ $exerciseIndex }}">
                                    <!-- Gyakorlat címsor -->
                                    <div class="flex justify-between items-center mb-3 md:mb-4">
                                        <h3 class="text-base md:text-lg font-semibold text-purple-600">
                                            <i class="fas fa-running mr-1 md:mr-2"></i>Gyakorlat #{{ $exerciseIndex }}
                                        </h3>
                                        <div class="flex space-x-2">
                                            <button type="button"
                                                class="remove-exercise bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-lg transition-colors"
                                                data-day-index="{{ $dayIndex }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Gyakorlat neve -->
                                    <div class="mb-3 md:mb-4">
                                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                            Gyakorlat neve:
                                        </label>
                                        <input type="text"
                                            name="exercise_name[{{ $dayIndex }}][{{ $exerciseIndex }}]"
                                            value="{{ $oldExerciseName }}"
                                            class="w-full px-3 md:px-4 py-2 md:py-2 border border-gray-200 rounded-lg 
                                                           focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                                                           transition-all text-base">
                                    </div>

                                    <!-- Táblázat set -->
                                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                                        <table
                                            class="min-w-full w-full table-auto divide-y divide-gray-200 text-xs md:text-sm">
                                            <thead class="bg-purple-50">
                                                <tr>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">
                                                        Set</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">
                                                        Ismétlések</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">
                                                        Súly (kg)</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">
                                                        Elvégezve</th>
                                                </tr>
                                            </thead>
                                            <tbody id="set_rows_day_{{ $dayIndex }}_exercise_{{ $exerciseIndex }}"
                                                class="bg-white divide-y divide-gray-200">
                                                @for ($setNum = 1; $setNum <= $currentSetCount; $setNum++)
                                                    @php
                                                        $setsVal = old(
                                                            "exercise_{$dayIndex}_{$exerciseIndex}_sets.$setNum",
                                                            $days[$dayIndex]['exercises'][$exerciseIndex]['sets'][
                                                                $setNum
                                                            ] ?? 0,
                                                        );
                                                        $weightVal = old(
                                                            "exercise_{$dayIndex}_{$exerciseIndex}_weight.$setNum",
                                                            $days[$dayIndex]['exercises'][$exerciseIndex]['weight'][
                                                                $setNum
                                                            ] ?? 0,
                                                        );
                                                        $doneVal = old(
                                                            "exercise_{$dayIndex}_{$exerciseIndex}_done.$setNum",
                                                            $days[$dayIndex]['exercises'][$exerciseIndex]['done'][
                                                                $setNum
                                                            ] ?? 0,
                                                        );
                                                    @endphp
                                                    <tr class="set-row hover:bg-gray-50 transition-colors">
                                                        <td class="px-2 md:px-4 py-2 text-gray-900 font-medium">
                                                            {{ $setNum }}
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="number"
                                                                name="exercise_{{ $dayIndex }}_{{ $exerciseIndex }}_sets[{{ $setNum }}]"
                                                                value="{{ $setsVal }}"
                                                                class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                                                                                                 focus:ring-2 focus:ring-purple-500 transition-all text-base">
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="number"
                                                                name="exercise_{{ $dayIndex }}_{{ $exerciseIndex }}_weight[{{ $setNum }}]"
                                                                value="{{ $weightVal }}"
                                                                class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                                                                                                 focus:ring-2 focus:ring-purple-500 transition-all text-base">
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="number"
                                                                name="exercise_{{ $dayIndex }}_{{ $exerciseIndex }}_done[{{ $setNum }}]"
                                                                value="{{ $doneVal }}"
                                                                class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                                                                                                 focus:ring-2 focus:ring-purple-500 transition-all text-base">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Set hozzáadása / törlése gombok -->
                                    <div class="flex justify-end mt-3 md:mt-4 space-x-2 md:space-x-3">
                                        <button type="button"
                                            class="add-set bg-purple-100 hover:bg-purple-200 text-purple-600 px-3 md:px-3 py-2 rounded-lg transition-colors flex items-center"
                                            data-day-index="{{ $dayIndex }}"
                                            data-exercise-index="{{ $exerciseIndex }}">
                                            <i class="fas fa-plus-circle "></i>
                                        </button>
                                        <button type="button"
                                            class="remove-set bg-red-100 hover:bg-red-200 text-red-600 px-3 md:px-4 py-2 rounded-lg transition-colors flex items-center"
                                            data-day-index="{{ $dayIndex }}"
                                            data-exercise-index="{{ $exerciseIndex }}">
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- Új gyakorlat gomb -->
                        <div class="flex justify-end mt-4 md:mt-6">
                            <button type="button"
                                class="add-exercise bg-purple-600 hover:bg-purple-700 text-white px-4 md:px-6 py-2 md:py-3 rounded-xl shadow-lg transition-all flex items-center"
                                data-day-index="{{ $dayIndex }}">
                                <i class="fas fa-plus-circle mr-1 md:mr-2"></i>Új gyakorlat
                            </button>
                        </div>
                    </div>
                @endfor

                <!-- Mentés gomb-->
                <div
                    class="z-50 mt-6 md:mt-8 text-center
                      fixed bottom-8 left-1/2 transform -translate-x-1/2">
                    <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700
                     text-white font-bold py-3 md:py-4 px-6 md:px-8 rounded-xl shadow-2xl
                     transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-sm md:text-base">
                        <i class="fas fa-save mr-1 md:mr-2"></i>Mentés & Frissítés
                    </button>
                </div>
            </form>
        </div>

        <script>
            // Új set-sor generálása
            function getSetRow(dayIndex, exerciseIndex, setNum) {
                return `
            <tr class="set-row hover:bg-gray-50 transition-colors">
              <td class="px-2 md:px-4 py-2 text-gray-900 font-medium">
                ${setNum}
              </td>
              <td class="px-2 md:px-4 py-2">
                <input
                  type="number"
                  name="exercise_${dayIndex}_${exerciseIndex}_sets[${setNum}]"
                  value="0"
                  class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                         focus:ring-2 focus:ring-purple-500 transition-all text-base"
                >
              </td>
              <td class="px-2 md:px-4 py-2">
                <input
                  type="number"
                  name="exercise_${dayIndex}_${exerciseIndex}_weight[${setNum}]"
                  value="0"
                  class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                         focus:ring-2 focus:ring-purple-500 transition-all text-base"
                >
              </td>
              <td class="px-2 md:px-4 py-2">
                <input
                  type="number"
                  name="exercise_${dayIndex}_${exerciseIndex}_done[${setNum}]"
                  value="0"
                  class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border rounded-lg 
                         focus:ring-2 focus:ring-purple-500 transition-all text-base"
                >
              </td>
            </tr>
          `;
            }

            function getExerciseBlock(dayIndex, exerciseIndex) {
                let setRows = "";
                for (let setNum = 1; setNum <= 4; setNum++) {
                    setRows += getSetRow(dayIndex, exerciseIndex, setNum);
                }

                return `
          <div
            class="exercise-block bg-gray-50 p-3 md:p-6 rounded-xl border-2 
                   border-dashed border-gray-200 hover:border-purple-200 
                   transition-all mb-4 md:mb-6"
            data-exercise-index="${exerciseIndex}"
          >
            <!-- Gyakorlat címsor -->
            <div class="flex justify-between items-center mb-3 md:mb-4">
              <h3 class="text-base md:text-lg font-semibold text-purple-600">
                <i class="fas fa-running mr-1 md:mr-2"></i>Gyakorlat #${exerciseIndex}
              </h3>
              <div class="flex space-x-2">
                <button
                  type="button"
                  class="remove-exercise bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-lg transition-colors"
                  data-day-index="${dayIndex}"
                >
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>

            <!-- Gyakorlat neve -->
            <div class="mb-3 md:mb-4">
              <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1 md:mb-2">
                Gyakorlat neve:
              </label>
              <input
                type="text"
                name="exercise_name[${dayIndex}][${exerciseIndex}]"
                class="w-full px-3 md:px-4 py-2 md:py-2 border border-gray-200 rounded-lg 
                       focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                       transition-all text-base"
                value=""
              >
            </div>

            <!-- Táblázat a set-eknek -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
              <table class="min-w-full w-full table-auto divide-y divide-gray-200 text-xs md:text-sm">
                <thead class="bg-purple-50">
                  <tr>
                    <th class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">Set</th>
                    <th class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">Ismétlések</th>
                    <th class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">Súly (kg)</th>
                    <th class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 uppercase">Elvégezve</th>
                  </tr>
                </thead>
                <tbody
                  id="set_rows_day_${dayIndex}_exercise_${exerciseIndex}"
                  class="bg-white divide-y divide-gray-200"
                >
                  ${setRows}
                </tbody>
              </table>
            </div>

            <!-- Set hozzáadása / törlése gombok -->
            <div class="flex justify-end mt-3 md:mt-4 space-x-2 md:space-x-3">
              <button
                type="button"
                class="add-set bg-purple-100 hover:bg-purple-200 text-purple-600 px-3 md:px-4 py-2 rounded-lg transition-colors flex items-center"
                data-day-index="${dayIndex}"
                data-exercise-index="${exerciseIndex}"
              >
                <i class="fas fa-plus-circle"></i>
              </button>
              <button
                type="button"
                class="remove-set bg-red-100 hover:bg-red-200 text-red-600 px-3 md:px-4 py-2 rounded-lg transition-colors flex items-center"
                data-day-index="${dayIndex}"
                data-exercise-index="${exerciseIndex}"
              >
                <i class="fas fa-minus-circle"></i>
              </button>
            </div>
          </div>
          `;
            }

            // Gyakorlat hozzáadása
            document.querySelectorAll('.add-exercise').forEach(function(button) {
                button.addEventListener('click', function() {
                    let dayIndex = this.getAttribute('data-day-index');
                    let container = document.getElementById('exercises_day_' + dayIndex);
                    let currentCount = container.querySelectorAll('.exercise-block').length;
                    let newIndex = currentCount + 1;
                    container.insertAdjacentHTML('beforeend', getExerciseBlock(dayIndex, newIndex));
                    attachHandlers();
                });
            });

            function removeExerciseHandler(e) {
                let dayIndex = this.getAttribute('data-day-index');
                let exerciseBlock = this.closest('.exercise-block');
                if (exerciseBlock) {
                    exerciseBlock.remove();
                }
            }

            document.querySelectorAll('.remove-exercise').forEach(function(button) {
                button.addEventListener('click', removeExerciseHandler);
            });

            function attachHandlers() {
                document.querySelectorAll('.add-set').forEach(function(button) {
                    button.removeEventListener('click', addSetHandler);
                    button.addEventListener('click', addSetHandler);
                });

                document.querySelectorAll('.remove-set').forEach(function(button) {
                    button.removeEventListener('click', removeSetHandler);
                    button.addEventListener('click', removeSetHandler);
                });

                document.querySelectorAll('.remove-exercise').forEach(function(btn) {
                    btn.removeEventListener('click', removeExerciseHandler);
                    btn.addEventListener('click', removeExerciseHandler);
                });
            }

            function addSetHandler() {
                let dayIndex = this.getAttribute('data-day-index');
                let exerciseIndex = this.getAttribute('data-exercise-index');
                let tbody = document.getElementById('set_rows_day_' + dayIndex + '_exercise_' + exerciseIndex);
                let currentRows = tbody.querySelectorAll('.set-row').length;
                let newSetNum = currentRows + 1;
                tbody.insertAdjacentHTML('beforeend', getSetRow(dayIndex, exerciseIndex, newSetNum));
            }

            function removeSetHandler() {
                let dayIndex = this.getAttribute('data-day-index');
                let exerciseIndex = this.getAttribute('data-exercise-index');
                let tbody = document.getElementById('set_rows_day_' + dayIndex + '_exercise_' + exerciseIndex);
                let rows = tbody.querySelectorAll('.set-row');
                if (rows.length > 1) {
                    rows[rows.length - 1].remove();
                }
            }

            attachHandlers();

            document.getElementById('workoutForm').addEventListener('submit', function() {
                for (let day = 1; day <= 3; day++) {
                    let exContainer = document.getElementById('exercises_day_' + day);
                    let blocks = exContainer.querySelectorAll('.exercise-block');
                    blocks.forEach(function(block, exIdx) {
                        let newExIdx = exIdx + 1;
                        block.setAttribute('data-exercise-index', newExIdx);

                        let h3 = block.querySelector('h3');
                        if (h3) {
                            h3.innerHTML = `<i class="fas fa-running mr-1 md:mr-2"></i>Gyakorlat #${newExIdx}`;
                        }

                        let nameInput = block.querySelector('input[type="text"]');
                        nameInput.name = `exercise_name[${day}][${newExIdx}]`;

                        let tbody = block.querySelector('tbody');
                        let setRows = tbody.querySelectorAll('.set-row');
                        setRows.forEach(function(row, setIdx) {
                            let newSetNum = setIdx + 1;
                            row.querySelector('td').innerText =
                                newSetNum;
                            let inputs = row.querySelectorAll('input');
                            inputs[0].name = `exercise_${day}_${newExIdx}_sets[${newSetNum}]`;
                            inputs[1].name = `exercise_${day}_${newExIdx}_weight[${newSetNum}]`;
                            inputs[2].name = `exercise_${day}_${newExIdx}_done[${newSetNum}]`;
                        });
                    });
                }
            });
        </script>

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

            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </body>
@endsection

</html>
