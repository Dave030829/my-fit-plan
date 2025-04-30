@extends('layouts.app')

@section('content')
    <div
        class="max-w-7xl mx-auto px-4 py-6 
            bg-white dark:bg-gray-900
            text-gray-900 dark:text-gray-100
            transition-colors duration-300">

        @if (session('success'))
            <div id="flashSuccess"
                class="fixed top-10 left-1/2 w-full max-w-lg px-4 transform -translate-x-1/2 
                    -translate-y-full transition-all duration-500 z-50"
                role="alert" aria-live="assertive">
                <div
                    class="p-4 border rounded-xl flex items-center gap-3 shadow-lg
                       bg-green-50 dark:bg-green-900
                       border-green-200 dark:border-green-800">
                    <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400"></i>
                    <span class="text-green-700 dark:text-green-300">
                        {{ session('success') }}
                    </span>
                </div>
            </div>
        @endif

        @if (session('error') || $errors->any())
            <div id="flashError"
                class="fixed top-10 left-1/2 w-full max-w-lg px-4 transform -translate-x-1/2 
                    -translate-y-full transition-all duration-500 z-50"
                role="alert" aria-live="assertive">
                <div
                    class="p-4 border rounded-xl flex items-center gap-3 shadow-lg
                       bg-red-50 dark:bg-red-900
                       border-red-200 dark:border-red-800">
                    <i class="fa-solid fa-circle-exclamation text-red-600 dark:text-red-400"></i>
                    <div class="text-red-700 dark:text-red-300">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2 mt-8">
                    Kihívások
                </h1>
                <p class="text-gray-500 dark:text-gray-400">
                    Válaszd ki, melyik feladatot szeretnéd teljesíteni.
                </p>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4">
                Aktuális Kihívásod
            </h2>
            @if ($userPivotChallenges->isEmpty())
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow p-4">
                    <p class="text-gray-600 dark:text-gray-200">
                        Jelenleg nincs kiválasztott kihívásod.
                    </p>
                </div>
                @php
                    $selectedChallengeId = null;
                    $selected = null;
                @endphp
            @else
                @php
                    $selected = $userPivotChallenges->first();
                    $selectedChallengeId = $selected->id;
                    $pivot = $selected->pivot;
                    $daysCompleted = $pivot->days_completed;
                    $totalDays = $selected->duration_in_days;
                    $progressPercent = round(($daysCompleted / $totalDays) * 100);
                    if ($progressPercent > 100) {
                        $progressPercent = 100;
                    }
                @endphp

                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                                {{ $selected->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Nap {{ $daysCompleted }} / {{ $totalDays }}
                                &middot; {{ $selected->difficulty }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ $progressPercent }}% Kész
                            </span>
                        </div>
                    </div>
                    <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-2.5 mb-4">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progressPercent }}%"></div>
                    </div>

                    @if ($daysCompleted < $totalDays)
                        <form action="{{ route('challenges.complete', $selected->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300
                                   transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                Mai nap teljesítve
                            </button>
                        </form>
                    @else
                        <p class="text-green-600 dark:text-green-400 font-medium">
                            Gratulálok, teljesítetted a kihívást!
                        </p>
                    @endif

                    {{-- Rangsor megnyitása --}}
                    @if (!$userPivotChallenges->isEmpty())
                        <div class="mt-4">
                            <button type="button" onclick="openLeaderboardModal()"
                                class="px-4 py-2 rounded-2xl bg-gray-600 text-white text-sm font-semibold
                                   hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300
                                   transition-colors">
                                Rangsor megnyitása
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        @if ($challenges->count() === 0)
            <p class="text-gray-500 dark:text-gray-400">
                Jelenleg nincsenek elérhető kihívások.
            </p>
        @else
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($challenges as $challenge)
                    @php
                        $isSelected = $selectedChallengeId && $challenge->id == $selectedChallengeId;
                        $badgeClasses = match ($challenge->difficulty) {
                            'könnyű' => 'bg-green-600 text-white',
                            'haladó' => 'bg-purple-600 text-white',
                            'nehéz' => 'bg-orange-600 text-white',
                            default => 'bg-gray-600 text-white',
                        };
                    @endphp
                    <div
                        class="relative flex flex-col bg-gray-100 dark:bg-gray-800 
                           rounded-lg shadow p-4
                           @if ($isSelected) opacity-50 cursor-not-allowed @endif">

                        {{-- Admin törlő gomb --}}
                        @if (auth()->user()->is_admin)
                            <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST"
                                class="absolute top-2 right-2" onsubmit="return confirm('Biztosan törlöd a kihívást?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-600 dark:text-red-500 
                                       hover:text-red-800 dark:hover:text-red-400
                                       focus:outline-none focus:ring-2 focus:ring-red-300
                                       transition-colors"
                                    title="Törlés">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        @endif

                        <div class="mb-3">
                            <h3 class="font-bold text-lg text-gray-800 dark:text-white">
                                {{ $challenge->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                @if ($challenge->description)
                                    {{ $challenge->description }}
                                @else
                                    Nincs leírás.
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $badgeClasses }}">
                                {{ $challenge->difficulty }}
                            </span>
                            <span class="text-xs text-gray-600 dark:text-gray-300">
                                {{ $challenge->duration_in_days }} nap
                            </span>
                        </div>

                        @if ($isSelected)
                            <button type="button"
                                class="px-4 py-2 rounded-2xl bg-gray-400 text-white text-sm font-semibold 
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                Kiválasztva
                            </button>
                        @else
                            @if ($userPivotChallenges->isEmpty())
                                <form action="{{ route('challenges.select', $challenge->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold
                                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300
                                           transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                        Kiválasztás
                                    </button>
                                </form>
                            @else
                                <form id="selectForm-{{ $challenge->id }}"
                                    action="{{ route('challenges.select', $challenge->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                                <button type="button" onclick="openChallengeModal({{ $challenge->id }})"
                                    class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold
                                       hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300
                                       transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    Kiválasztás
                                </button>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if (auth()->user()->is_admin)
            <div class="mt-12">
                <h2 class="text-xl font-semibold mb-4">
                    Új kihívás létrehozása (Admin)
                </h2>
                <form action="{{ route('challenges.store') }}" method="POST"
                    class="bg-gray-200 dark:bg-gray-800 p-4 rounded">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block font-medium mb-1 text-gray-800 dark:text-gray-200">
                            Cím
                        </label>
                        <input type="text" id="title" name="title"
                            class="w-full border border-gray-300 dark:border-gray-700 
                               rounded-2xl px-3 py-2 focus:outline-none focus:ring
                               bg-gray-100 dark:bg-gray-700
                               text-gray-800 dark:text-gray-100"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium mb-1 text-gray-800 dark:text-gray-200">
                            Leírás
                        </label>
                        <textarea id="description" name="description"
                            class="w-full border border-gray-300 dark:border-gray-700 
                               rounded-2xl px-3 py-2 focus:outline-none focus:ring
                               bg-gray-100 dark:bg-gray-700
                               text-gray-800 dark:text-gray-100"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="difficulty" class="block font-medium mb-1 text-gray-800 dark:text-gray-200">
                            Nehézség
                        </label>
                        <select id="difficulty" name="difficulty"
                            class="w-full border border-gray-300 dark:border-gray-700 
                               rounded-2xl px-3 py-2 focus:outline-none focus:ring
                               bg-gray-100 dark:bg-gray-700
                               text-gray-800 dark:text-gray-100"
                            required>
                            <option value="" disabled selected>Válassz</option>
                            <option value="könnyű">Könnyű</option>
                            <option value="haladó">Haladó</option>
                            <option value="nehéz">Nehéz</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="duration_in_days" class="block font-medium mb-1 text-gray-800 dark:text-gray-200">
                            Hány napos?
                        </label>
                        <input type="number" id="duration_in_days" name="duration_in_days"
                            class="w-full border border-gray-300 dark:border-gray-700 
                               rounded-2xl px-3 py-2 focus:outline-none focus:ring
                               bg-gray-100 dark:bg-gray-700
                               text-gray-800 dark:text-gray-100"
                            min="1" required>
                    </div>

                    <button type="submit"
                        class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold
                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300
                           transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Létrehozás
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- "Biztos váltani akarsz?" modál --}}
    <div id="challengeModal"
        class="fixed inset-0 bg-black/30 dark:bg-black/40 
           backdrop-blur-sm hidden items-center justify-center 
           p-5 text-sm md:text-base z-50">
        <div class="bg-gray-100 dark:bg-gray-800
                rounded-xl shadow-lg p-4 md:p-6 w-full max-w-md relative">
            <button
                class="absolute top-2 left-2 text-gray-600 dark:text-gray-300 
                  hover:text-gray-800 dark:hover:text-gray-100"
                onclick="closeChallengeModal()">
                <i class="fa-solid fa-times text-lg"></i>
            </button>
            <h3
                class="text-lg md:text-xl font-semibold mb-3 md:mb-4
                   text-center text-gray-800 dark:text-gray-100">
                Figyelem!
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Már van egy kiválasztott kihívásod. Ha folytatod,
                az addigi eredményeid el fognak veszni. Biztosan folytatod?
            </p>
            <div class="flex justify-end gap-3">
                <button
                    class="px-4 py-2 rounded-2xl bg-gray-400 text-white text-sm font-semibold
                      hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300
                      transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    onclick="closeChallengeModal()">
                    Mégse
                </button>
                <button id="confirmBtn"
                    class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold
                       hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300
                       transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Igen, folytatom
                </button>
            </div>
        </div>
    </div>

    {{-- LEADERBOARD MODAL --}}
    @if ($selected)
        <div id="leaderboardModal"
            class="fixed inset-0 bg-black/30 dark:bg-black/40 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-6 w-full max-w-lg relative transition-all">

                <!-- Bezárás gomb -->
                <button
                    class="absolute top-3 right-3 p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    onclick="closeLeaderboardModal()">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>

                <!-- Fejléc -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                        🏆 Kihívás Rangsor
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $selected->title }} ({{ $selected->duration_in_days }} nap)
                    </p>
                </div>

                @if ($leaderboard->isNotEmpty())
                    @php
                        $currentUserId = auth()->id();
                        $userEntry = $leaderboard->firstWhere('id', $currentUserId);
                    @endphp

                    <ol class="space-y-3">
                        @foreach ($leaderboard as $index => $participant)
                            @php
                                $rank = $index + 1;
                                $completed = $participant->pivot->days_completed;
                                $progress = ($completed / $selected->duration_in_days) * 100;

                                $isCurrentUser = $participant->id === $currentUserId;

                            @endphp

                            <li
                                class="group flex items-center p-4 rounded-xl transition-all
                        {{ $isCurrentUser
                            ? 'bg-blue-100/30 dark:bg-blue-900/30 border-2 border-blue-400 dark:border-blue-500 shadow-lg'
                            : 'hover:bg-gray-600 dark:hover:bg-gray-800' }}">

                                <!-- Helyezés / Érem -->
                                <div class="w-12 flex-shrink-0">
                                    <span class="text-lg font-bold dark:text-white">
                                        @switch($rank)
                                            @case(1)
                                                🥇
                                            @break

                                            @case(2)
                                                🥈
                                            @break

                                            @case(3)
                                                🥉
                                            @break

                                            @default
                                                #{{ $rank }}
                                        @endswitch
                                    </span>
                                </div>

                                <!-- Felhasználói adatok -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <span
                                            class="
                                        truncate 
                                        {{ $isCurrentUser
                                            ? 'text-blue-700 dark:text-blue-400 font-extrabold text-xl'
                                            : 'text-gray-800 dark:text-gray-200 font-medium' }}
                                    ">
                                            @if ($isCurrentUser)
                                                {{ $participant->username }} (Te)
                                            @else
                                                {{ $participant->username }}
                                            @endif
                                        </span>
                                        <span
                                            class="text-sm 
                                        {{ $isCurrentUser ? 'text-blue-700 dark:text-blue-400 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
                                            {{ $completed }}/{{ $selected->duration_in_days }} nap
                                        </span>
                                    </div>

                                    <!-- Haladás (progress bar) -->
                                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full transition-all duration-500 ease-out 
                                    {{ $isCurrentUser ? 'bg-gradient-to-r from-blue-400 to-purple-500' : 'bg-blue-400' }}"
                                            style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @else
                    {{-- Ha nincs résztvevő --}}
                    <div class="text-center py-8">
                        <div class="mb-4 text-gray-400 dark:text-gray-500 text-6xl">
                            🏃‍♂️💨
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">
                            Légy te az első, aki csatlakozik ehhez a kihíváshoz! 🚀
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif


    <script>
        let currentChallengeId = null;

        function openChallengeModal(challengeId) {
            currentChallengeId = challengeId;
            const modal = document.getElementById('challengeModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeChallengeModal() {
            currentChallengeId = null;
            const modal = document.getElementById('challengeModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('confirmBtn').addEventListener('click', function() {
            if (currentChallengeId) {
                const formId = 'selectForm-' + currentChallengeId;
                document.getElementById(formId).submit();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = ['flashSuccess', 'flashError'];
            flashMessages.forEach(function(id) {
                const element = document.getElementById(id);
                if (element) {
                    setTimeout(() => {
                        element.classList.remove('-translate-y-full');
                        element.classList.add('translate-y-0');
                    }, 100);
                    setTimeout(() => {
                        element.classList.remove('translate-y-0');
                        element.classList.add('-translate-y-full');
                    }, 3100);
                    setTimeout(() => {
                        element.remove();
                    }, 3600);
                }
            });
        });

        function openLeaderboardModal() {
            const modal = document.getElementById('leaderboardModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLeaderboardModal() {
            const modal = document.getElementById('leaderboardModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <style>
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        .hover\:bg-gray-50:hover {
            background-color: #f9fafb;
        }

        .dark .dark\:hover\:bg-gray-800:hover {
            background-color: #1f2937;
        }
    </style>
@endsection
