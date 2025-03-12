@extends('layouts.app')

@section('content')
    <!-- Gomb, ami megnyitja a drawert -->
    <div class="relative">
        <button
            class="fixed top-16 left-0 flex items-center justify-center w-12 h-12  md:hidden
                   bg-purple-500 dark:bg-teal-500 text-white rounded-r-full shadow-md 
                   hover:bg-purple-600 dark:hover:bg-teal-600 transition-all 
                   focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-teal-800"
            type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Drawer navigációs komponens -->
    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen p-4 pt-20 overflow-y-auto 
               transition-transform -translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-navigation-label">

        <!-- Drawer címsor -->
        <div class="flex justify-between">
            <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                Menü
            </h5>
            <!-- Bezáró gomb -->
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                       rounded-lg dark:hover:bg-gray-600 dark:hover:text-white">
                <i class="fa-solid fa-x"></i>
            </button>
        </div>

        <!-- Menü elemek listája -->
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <!-- Főoldal -->
                <li>
                    <a href="{{ route('welcome') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-home w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Főoldal</span>
                    </a>
                </li>
                <!-- Kalória követő -->
                <li>
                    <a href="{{ route('calorie.tracker') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-fire w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Kalória követő</span>
                    </a>
                </li>
                <!-- Edzés tervező -->
                <li>
                    <a href="{{ route('workout.create') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-dumbbell w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Edzés tervező</span>
                    </a>
                </li>
                <!-- Kalória számoló -->
                <li>
                    <a href="{{ route('calorie.calculator') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-calculator w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Kalória számoló</span>
                    </a>
                </li>
                <!-- Napi teendők -->
                <li>
                    <a href="{{ route('daily-tasks.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-list-check w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Napi teendők</span>
                    </a>
                </li>
            </ul>

            <!-- Felhasználói műveletek (pl. bejelentkezés, kijelentkezés) -->
            <div class="mt-5 border-t border-gray-300 dark:border-gray-700 pt-3 mb-5 px-2">
                @if (auth()->check())
                    <div class="space-y-2">
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 
                                   rounded-md py-2">
                            <i
                                class="fas fa-user text-gray-700 dark:text-gray-300 
                                      dark:bg-gray-700 bg-gray-300 rounded-full p-3"></i>
                            <span class="font-semibold dark:text-gray-300">{{ auth()->user()->username }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="text-left">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-3 py-2 rounded-md 
                                       hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors 
                                       dark:text-gray-300">
                                <i class="fas fa-sign-out-alt mr-2"></i> Kijelentkezés
                            </button>
                        </form>
                    </div>
                @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}"
                            class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 
                                   transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i> Bejelentkezés
                        </a>
                        <a href="{{ route('register.create') }}"
                            class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 
                                   transition-colors">
                            <i class="fas fa-user-plus mr-2"></i> Regisztráció
                        </a>
                        <a href="{{ route('auth.google') }}"
                            class="flex items-center px-3 py-2 rounded-xl bg-purple-800 hover:bg-purple-900 
                                   transition-colors dark:bg-gray-700 dark:hover:bg-gray-600">
                            <svg viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45
                                                                                                                     12.04-9.283 30.172-26.69 42.356l-.244 1.622
                                                                                                                     38.755 30.023 2.685.268c24.659-22.774
                                                                                                                     38.875-56.282 38.875-96.027"
                                        fill="#4285F4">
                                    </path>
                                    <path
                                        d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024
                                                                                                                     7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13
                                                                                                                     -40.298 31.187-.527 1.465C35.393 231.798
                                                                                                                     79.49 261.1 130.55 261.1"
                                        fill="#34A853">
                                    </path>
                                    <path
                                        d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994
                                                                                                                     1.595-17.697 4.206-25.82l-.073-1.73L15.26
                                                                                                                     71.312l-1.335.635C5.077 89.644 0 109.517
                                                                                                                     0 130.55s5.077 40.905 13.925 58.602l42.356
                                                                                                                     -32.782"
                                        fill="#FBBC05">
                                    </path>
                                    <path
                                        d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245
                                                                                                                     12.91 165.798 0 130.55 0 79.49 0 35.393
                                                                                                                     29.301 13.925 71.947l42.211 32.783c10.59
                                                                                                                     -31.477 39.891-54.251 74.414-54.251"
                                        fill="#EB4335">
                                    </path>
                                </g>
                            </svg>
                            <span class="text-white">Google</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Verzió információ -->
            <div class="p-4 border-t border-gray-300 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Verzió: 1.1.0
                </p>
            </div>
        </div>
    </div>

    <!-- Az oldal többi tartalma -->
    <div
        class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 
               min-h-screen flex flex-col md:pt-0">
        <div class="relative flex flex-col items-center justify-center flex-grow text-center py-12 px-4 min-h-screen">
            <!-- Background SVG -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <svg class="absolute top-0 left-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 800 800">
                    <circle cx="200" cy="200" r="120" fill="#0d9488" />
                    <circle cx="600" cy="600" r="160" fill="#2563eb" />
                </svg>
            </div>

            <h1
                class="text-4xl sm:text-6xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 
                       dark:from-teal-400 dark:to-blue-400 bg-clip-text text-transparent mb-4 pt-4">
                Üdvözöllek a Fit Appban!
            </h1>
            <p class="max-w-xl text-gray-700 dark:text-gray-300 mb-6 text-lg sm:text-xl">
                Itt mindent megtalálsz az edzésed és az étrended nyomon követéséhez.
                Céljaid eléréséhez pedig legyen a társad a Fit App!
            </p>

            <!-- Gombok / linkek -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('calorie.tracker') }}"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-600 dark:to-blue-600 
                           hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 
                           text-white font-semibold px-8 py-3 rounded-full shadow-xl transition-transform 
                           hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-fire mr-2"></i>Kalória követő
                </a>
                <a href="{{ route('workout.create') }}"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-600 dark:to-blue-600 
                           hover:from-purple-700 hover:to-indigo-700 dark:hover:from-teal-700 dark:hover:to-blue-700 
                           text-white font-semibold px-8 py-3 rounded-full shadow-xl transition-transform 
                           hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-dumbbell mr-2"></i>Edzés tervező
                </a>
            </div>
        </div>

        <div class="bg-white/90 dark:bg-gray-800/90 py-8 shadow-inner rounded-xl mb-5">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap gap-6 justify-center">
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-600 dark:bg-teal-800 p-4 rounded-full mb-3">
                        <i class="fas fa-heartbeat text-purple-300 dark:text-teal-300 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700 dark:text-gray-100">Egészséges életmód</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                        Kövesd nyomon kalória-fogyasztásod és maradj fitt!
                    </p>
                </div>
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-600 dark:bg-teal-800 p-4 rounded-full mb-3">
                        <i class="fas fa-chart-line text-purple-300 dark:text-teal-300 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700 dark:text-gray-100">Részletes statisztikák</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                        Ismerd meg az előrehaladásod grafikonokon és diagramokon keresztül.
                    </p>
                </div>
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-600 dark:bg-teal-800 p-4 rounded-full mb-3">
                        <i class="fas fa-users text-purple-300 dark:text-teal-300 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700 dark:text-gray-100">Közösség és motiváció</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                        Oszd meg eredményeidet és kapj támogatást a fitnesz céljaidhoz.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.6.4/dist/flowbite.min.js"></script>
@endsection
