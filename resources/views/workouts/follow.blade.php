@extends('layouts.app')
@section('content')
    @include('partials.flash-messages')

    <div class="max-w-7xl mx-auto mt-5">
        <!-- Főcímsor -->
        <h1
            class="text-2xl sm:text-5xl font-extrabold text-center mb-8
                   bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-400 dark:to-blue-400
                   bg-clip-text text-transparent">
            <i class="fas fa-dumbbell mr-3"></i>Edzés Követése
        </h1>

        <div
            class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm shadow-2xl rounded-2xl
                   px-3 md:px-8 pt-6 md:pt-8 pb-14 md:pb-16 mb-4">

            <!-- Napválasztó gombok -->
            <div class="flex flex-wrap gap-3 justify-center mb-8">
                @foreach ($days as $dayIndex => $dayData)
                    <button type="button"
                        class="px-4 py-2 rounded-md font-medium text-white bg-purple-600
                               hover:bg-purple-700 transition-colors duration-200
                               dark:bg-teal-600 dark:hover:bg-teal-700"
                        onclick="selectDay({{ $dayIndex }})">
                        {{ $dayData['dayName'] ?? 'Nap #' . $dayIndex }}
                    </button>
                @endforeach
            </div>

            <!-- Edzés újrakezdése gomb -->
            <div class="flex justify-center mb-6">
                <button type="button"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-700 dark:to-blue-500
                           hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-800 dark:hover:to-blue-600
                           text-white font-bold py-2 md:py-3 px-4 md:px-6 rounded-xl shadow-2xl
                           transform transition-all duration-200 hover:scale-105 hover:shadow-xl text-sm md:text-base
                           flex items-center gap-2"
                    onclick="resetAndSubmit()">
                    <i class="fas fa-undo-alt"></i>
                    <span>Edzés újrakezdése</span>
                </button>
            </div>

            <!-- Form – normál submit -->
            <form action="{{ route('workouts.saveFollow') }}" method="POST" id="workoutFollowForm">
                @csrf

                @foreach ($days as $dayIndex => $dayData)
                    <div class="day-block mb-8 hidden" id="dayBlock{{ $dayIndex }}">
                        <!-- Nap fejléc -->
                        <div class="relative group mb-6 md:mb-8">
                            <div
                                class="relative bg-gradient-to-r from-purple-600 to-indigo-600
                                           dark:from-teal-400 dark:to-blue-400 p-4 md:p-6 rounded-lg shadow-lg">
                                <h2 class="text-lg md:text-2xl font-bold text-white flex items-center">
                                    <span class="bg-white/20 dark:bg-gray-700 p-2 rounded-lg mr-3 md:mr-4">
                                        <i class="fas fa-calendar-day text-white"></i>
                                    </span>
                                    {{ $dayData['dayName'] ?? 'Nap #' . $dayIndex }}
                                </h2>
                            </div>
                        </div>

                        <!-- Nap neve -->
                        <div class="mb-6 md:mb-8">
                            <label
                                class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 md:mb-2">
                                Nap neve:
                            </label>
                            <div
                                class="px-3 md:px-4 py-2 md:py-3 border-2 border-gray-200 dark:border-gray-600
                                       rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100
                                       pointer-events-none select-none">
                                {{ $dayData['dayName'] ?? '' }}
                            </div>
                        </div>

                        <!-- Gyakorlatok -->
                        @if (!empty($dayData['exercises']))
                            @foreach ($dayData['exercises'] as $exIndex => $exercise)
                                <div
                                    class="exercise-block bg-gray-50 dark:bg-gray-700 p-3 md:p-6
                                           rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600
                                           hover:border-purple-200 dark:hover:border-teal-400 transition-all mb-6">

                                    <div class="flex justify-between items-center mb-3 md:mb-4">
                                        <h3 class="text-base md:text-lg font-semibold text-purple-600 dark:text-teal-300">
                                            <i class="fas fa-running mr-1 md:mr-2"></i>
                                            Gyakorlat #{{ $exIndex }}
                                        </h3>
                                    </div>

                                    <!-- Gyakorlat neve -->
                                    <div class="mb-3 md:mb-4">
                                        <label
                                            class="block text-xs md:text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 md:mb-2">
                                            Gyakorlat neve:
                                        </label>
                                        <div
                                            class="px-3 md:px-4 py-2 md:py-2 border border-gray-200 dark:border-gray-600
                                                   rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100
                                                   pointer-events-none select-none">
                                            {{ $exercise['name'] ?? '' }}
                                        </div>
                                    </div>

                                    <!-- Táblázat: set / weight / done -->
                                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-600">
                                        <table
                                            class="min-w-full w-full table-auto divide-y divide-gray-200 dark:divide-gray-600 text-xs md:text-sm">
                                            <thead class="bg-purple-50 dark:bg-gray-600">
                                                <tr>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 dark:text-teal-200 uppercase">
                                                        Set</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 dark:text-teal-200 uppercase">
                                                        Ismétlések</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 dark:text-teal-200 uppercase">
                                                        Súly (kg)</th>
                                                    <th
                                                        class="px-2 md:px-4 py-2 md:py-3 text-left font-semibold text-purple-600 dark:text-teal-200 uppercase">
                                                        Elvégezve</th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                                @php
                                                    $exerciseSets = $exercise['sets'] ?? [];
                                                    $exerciseWeight = $exercise['weight'] ?? [];
                                                    $exerciseDone = $exercise['done'] ?? [];
                                                @endphp
                                                @foreach ($exerciseSets as $setNum => $repCount)
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                        <td
                                                            class="px-2 md:px-4 py-2 text-gray-900 dark:text-gray-100 font-medium">
                                                            {{ $setNum }}
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="number"
                                                                name="exercise_{{ $dayIndex }}_{{ $exIndex }}_sets[{{ $setNum }}]"
                                                                inputmode="numeric" value="{{ $repCount }}"
                                                                class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border border-gray-200
                                                                          dark:border-gray-600 rounded-lg focus:ring-2
                                                                          focus:ring-purple-500 dark:focus:ring-teal-500
                                                                          transition-all text-base bg-white dark:bg-gray-800
                                                                          text-gray-800 dark:text-gray-100">
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="number" inputmode="numeric"
                                                                name="exercise_{{ $dayIndex }}_{{ $exIndex }}_weight[{{ $setNum }}]"
                                                                value="{{ $exerciseWeight[$setNum] ?? 0 }}"
                                                                class="w-12 sm:w-16 md:w-24 px-2 md:px-3 py-1 border border-gray-200
                                                                          dark:border-gray-600 rounded-lg focus:ring-2
                                                                          focus:ring-purple-500 dark:focus:ring-teal-500
                                                                          transition-all text-base bg-white dark:bg-gray-800
                                                                          text-gray-800 dark:text-gray-100">
                                                        </td>
                                                        <td class="px-2 md:px-4 py-2">
                                                            <input type="hidden"
                                                                name="exercise_{{ $dayIndex }}_{{ $exIndex }}_done[{{ $setNum }}]"
                                                                value="0">
                                                            <input type="checkbox"
                                                                name="exercise_{{ $dayIndex }}_{{ $exIndex }}_done[{{ $setNum }}]"
                                                                value="1"
                                                                class="h-5 w-5 sm:h-6 sm:w-6 rounded border-gray-300
                                                                          text-purple-600 dark:text-teal-400 focus:ring-purple-500
                                                                          dark:focus:ring-teal-500 cursor-pointer"
                                                                @if (!empty($exerciseDone[$setNum])) checked @endif>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach

                <!-- Mentés gomb: normál form submit -->
                <div class="flex justify-center mt-6">
                    <button type="submit"
                        class="dark:bg-white bg-gray-300 text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group">
                        <div
                            class="dark:bg-teal-400 bg-purple-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </div>
                        <p class="translate-x-2">Mentés</p>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1) Nap-kiválasztás (opcionálisan 3 óráig localStorage-ben)
        document.addEventListener('DOMContentLoaded', () => {
            initDaySelection();
        });

        const DAY_STORAGE_KEY = 'selectedWorkoutDay';
        const DAY_TS_KEY = 'selectedWorkoutDayTime';
        const HOUR_3_MS = 3 * 60 * 60 * 1000;

        function initDaySelection() {
            let storedDay = localStorage.getItem(DAY_STORAGE_KEY);
            let storedDayTs = localStorage.getItem(DAY_TS_KEY);
            let now = Date.now();

            if (storedDay && storedDayTs) {
                if (now - storedDayTs < HOUR_3_MS) {
                    showDayBlock(storedDay);
                    return;
                } else {
                    localStorage.removeItem(DAY_STORAGE_KEY);
                    localStorage.removeItem(DAY_TS_KEY);
                }
            }
            // Ha nincs érvényes day, default: 1
            showDayBlock(1);
        }

        function selectDay(dayIndex) {
            localStorage.setItem(DAY_STORAGE_KEY, dayIndex);
            localStorage.setItem(DAY_TS_KEY, Date.now());
            showDayBlock(dayIndex);
        }

        function showDayBlock(dayIndex) {
            document.querySelectorAll('.day-block').forEach(block => {
                block.classList.add('hidden');
            });
            let active = document.getElementById('dayBlock' + dayIndex);
            if (active) {
                active.classList.remove('hidden');
            }
        }

        // 2) Edzés újrakezdése: uncheck + submit
        function resetAndSubmit() {
            // Kikapcsoljuk az összes "done" checkboxot
            const doneCheckboxes = document.querySelectorAll('input[type="checkbox"][name*="_done["]');
            doneCheckboxes.forEach(cb => {
                cb.checked = false;
            });

            // Utána azonnal beküldjük a formot (lapfrissítés)
            document.getElementById('workoutFollowForm').submit();
        }
    </script>
@endsection
