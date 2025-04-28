<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-title" content="My Fit Plan">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no viewport-fit=cover">
    <title>My Fit Plan</title>
    @vite(entrypoints: 'resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        .pt-safe-top {
            padding-top: env(safe-area-inset-top);
        }
    </style>
</head>

@php
    $currentRoute = Route::currentRouteName();
@endphp

<body
    class="pt-safe-top flex min-h-screen bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 ">
    <!-- Desktop Sidebar (hidden on phone view) -->
    <aside id="sidebar"
        class="hidden md:block fixed top-0 left-0 w-64 h-full bg-purple-600 text-white transform -translate-x-full transition-transform duration-300 z-50 dark:bg-gray-800 dark:border-r dark:border-gray-700">
        <!-- Navigációs elemek -->
        <nav class="p-4 space-y-2 pt-20">
            <a href="{{ route('welcome') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fas fa-home mr-2"></i>Főoldal
            </a>
            <a href="{{ route('calorie.tracker') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fas fa-fire mr-2"></i>Kalória követő
            </a>
            <a href="{{ route('workout.create') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fa-solid fa-calendar-days mr-2"></i>Edzés tervező
            </a>
            <a href="{{ route('calorie.calculator') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fas fa-calculator mr-2"></i>Kalória számoló
            </a>
            <a href="{{ route('daily-tasks.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fa-solid fa-list-check mr-2"></i>Napi teendők
            </a>
            <a href="{{ route('workouts.follow') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fas fa-dumbbell mr-2"></i>Edzés követő
            </a>
            <a href="{{ route('challenges.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200 dark:hover:bg-gray-700">
                <i class="fa-solid fa-bullseye mr-2"></i>Kihívások
            </a>
        </nav>

        <!-- Felhasználói műveletek -->
        <div class="mt-5 px-4 border-t border-purple-400/50 pt-3 mb-5 dark:border-gray-700">
            @if (auth()->check())
                <div class="space-y-2">
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center space-x-2 hover:bg-white/10 rounded-md px-3 py-2 dark:hover:bg-gray-700">
                        <div class="rounded-full">
                            <i class="fas fa-user text-white dark:text-gray"></i>
                        </div>
                        <span class="font-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="text-left">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-3 py-2 rounded-md hover:bg-white/10 transition-colors dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Kijelentkezés
                        </button>
                    </form>
                </div>
            @else
                <div class="space-y-2 mb-5">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors dark:hover:bg-gray-700">
                        <i class="fas fa-sign-in-alt mr-2"></i> Bejelentkezés
                    </a>
                    <a href="{{ route('register.create') }}"
                        class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors dark:hover:bg-gray-700">
                        <i class="fas fa-user-plus mr-2"></i> Regisztráció
                    </a>
                    <a href="{{ route('auth.google') }}"
                        class="flex items-center px-3 py-2 rounded-xl bg-purple-800 hover:bg-purple-900 transition-colors dark:bg-gray-700 dark:hover:bg-gray-600">
                        <svg viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283
                  30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774
                  38.875-56.282 38.875-96.027" fill="#4285F4"></path>
                                <path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82
                  13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298
                  31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"></path>
                                <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697
                  4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0
                  130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"></path>
                                <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245
                  12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211
                  32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"></path>
                            </g>
                        </svg> <span>Google</span>
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-auto p-4 border-t border-purple-400/50 dark:border-gray-700">
            <p class="text-sm text-purple-100/70 dark:text-gray-400">Verzió: 1.1.0</p>
        </div>
    </aside>

    <!-- Main content container -->
    <div class="flex-1 flex flex-col">
        <!-- Desktop Navbar (hidden on phone view) -->
        <nav
            class="hidden md:block bg-gradient-to-r from-purple-600 to-indigo-600 text-white sticky top-0 z-50 shadow-xl w-full dark:from-teal-400 dark:to-blue-400 dark:border-b dark:border-gray-600">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('welcome') }}" class="font-bold text-xl">My Fit Plan</a>
                        <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-white/10 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 flex-grow flex flex-col items-center justify-center mb-20">
            @yield('content')
        </main>

        <!-- Desktop Footer (hidden on phone view) -->
        <footer
            class="hidden md:block bg-gradient-to-r from-purple-600 to-indigo-600 text-white border-t border-white/10 dark:from-teal-400 dark:to-blue-400 dark:border-t dark:border-gray-600">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-bold mb-4">Navigáció</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('welcome') }}"
                                    class="hover:text-purple-400 transition-colors duration-300 dark:hover:text-teal-400">Főoldal</a>
                            </li>
                            <li><a href="{{ route('calorie.tracker') }}"
                                    class="hover:text-purple-400 transition-colors duration-300 dark:hover:text-teal-400">Kalória
                                    követő</a></li>
                            <li><a href="{{ route('workout.create') }}"
                                    class="hover:text-purple-400 transition-colors duration-300 dark:hover:text-teal-400">Edzés
                                    tervező</a></li>
                        </ul>
                    </div>

                    <div class="text-center">
                        <h3 class="text-xl font-bold mb-4">Kapcsolat</h3>
                        <div class="space-y-2">
                            <p><i class="fas fa-envelope mr-2"></i>myfitplaneu@gmail.com</p>
                            <p><i class="fas fa-phone mr-2"></i>+36 1 234 5678</p>
                        </div>
                    </div>

                    <div class="text-center md:text-right">
                        <h3 class="text-xl font-bold mb-4">Kövess minket</h3>
                        <div class="flex justify-center md:justify-end space-x-4">
                            <a href="#" class="p-2">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="p-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="p-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/10 mt-8 pt-6 text-center dark:border-gray-600">
                    <p class="text-sm text-white/80 dark:text-gray-600">
                        &copy; {{ date('Y') }} - Az én Laravel alkalmazásom. Minden jog fenntartva.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Mobile Navbar (visible only on phone view) -->
    <div class="md:hidden">
        <div
            class="fixed z-50 w-full h-20 pb-5 bg-white border border-gray-200 bottom-0 left-0 dark:bg-gray-700 dark:border-gray-600">
            @php
                $iconCalorie =
                    $currentRoute === 'calorie.tracker'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';
                $textCalorie =
                    $currentRoute === 'calorie.tracker'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';

                $iconWorkout =
                    $currentRoute === 'workouts.follow'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';
                $textWorkout =
                    $currentRoute === 'workouts.follow'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';

                $iconHome = 'text-white';
                $textHome = 'text-blue-600 font-bold';

                $iconCalculator =
                    $currentRoute === 'calorie.calculator'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';
                $textCalculator =
                    $currentRoute === 'calorie.calculator'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';

                $iconTasks =
                    $currentRoute === 'daily-tasks.index'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';
                $textTasks =
                    $currentRoute === 'daily-tasks.index'
                        ? 'text-purple-500 dark:text-teal-500'
                        : 'text-gray-500 dark:text-gray-400 group-hover:text-purple-500 dark:group-hover:text-teal-500';
            @endphp


            <div class="grid h-full grid-cols-5">
                <!-- 1: Kalória követő -->
                <a href="{{ route('calorie.tracker') }}"
                    class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <i class="fas fa-fire text-xl {{ $iconCalorie }}"></i>
                    <span class="text-xs mt-1 {{ $textCalorie }}">Kalória</span>
                </a>

                <!-- 2: Edzés tervező -->
                <a href="{{ route('workouts.follow') }}"
                    class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <i class="fas fa-dumbbell text-xl {{ $iconWorkout }}"></i>
                    <span class="text-xs mt-1 {{ $textWorkout }}">Edzés</span>
                </a>

                <!-- 3: Főoldal – kiemelt, középen -->
                <a href="{{ route('welcome') }}"
                    class="relative flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <div
                        class="absolute bottom-0 w-16 h-16 dark:bg-teal-600 bg-purple-600 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-home text-2xl {{ $iconHome }}"></i>
                    </div>
                </a>

                <!-- 4: Kalória számoló -->
                <a href="{{ route('calorie.calculator') }}"
                    class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <i class="fas fa-calculator text-xl {{ $iconCalculator }}"></i>
                    <span class="text-xs mt-1 {{ $textCalculator }}">Számoló</span>
                </a>

                <!-- 5: Napi teendők -->
                <a href="{{ route('daily-tasks.index') }}"
                    class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <i class="fa-solid fa-list-check text-xl {{ $iconTasks }}"></i>
                    <span class="text-xs mt-1 {{ $textTasks }}">Teendők</span>
                </a>
            </div>
        </div>
    </div>



    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
