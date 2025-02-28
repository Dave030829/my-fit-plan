<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alkalmazás címe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="flex min-h-screen bg-gradient-to-br from-purple-50 to-indigo-50">
    <aside id="sidebar"
        class="fixed top-0 left-0 w-64 h-full bg-indigo-600 text-white transform -translate-x-full transition-transform duration-300 z-50">

        <!-- Fejléc / Logó a sidebar tetején -->
        <div class="flex items-center h-16 px-4 shadow bg-indigo-700">
            <i class="fas fa-cube text-2xl mr-2"></i>
            <span class="font-bold text-lg">Az App</span>
        </div>

        <!-- Navigációs elemek (ÁTHOZVA a régi menük) -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('welcome') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">
                <i class="fas fa-home mr-2"></i>Főoldal
            </a>
            <a href="{{ route('calorie.tracker') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">
                <i class="fas fa-fire mr-2"></i>Kalória követő
            </a>
            <a href="{{ route('workout.create') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">
                <i class="fas fa-dumbbell mr-2"></i>Edzés tervező
            </a>
            <a href="{{ route('calorie.calculator') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">
                <i class="fas fa-calculator mr-2"></i>Kalória számoló
            </a>
        </nav>

        <!-- Felhasználói műveletek -->
        <div class="mt-5 px-4 border-t border-indigo-400/50 pt-3 mb-5">
            @if (auth()->check())
                <div class="space-y-2">
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center space-x-2 hover:bg-white/10 rounded-md px-3 py-2">
                        <div class="bg-white/20 rounded-full">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="font-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="text-left">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-3 py-2 rounded-md hover:bg-white/10 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i> Kijelentkezés
                        </button>
                    </form>
                </div>
            @else
                <div class="space-y-2 mb-5">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i> Bejelentkezés
                    </a>
                    <a href="{{ route('register.create') }}"
                        class="block px-3 py-2 rounded-md hover:bg-white/10 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i> Regisztráció
                    </a>
                    <a href="{{ route('auth.google') }}"
                        class="flex items-center px-3 py-2 rounded-xl bg-purple-800 hover:bg-purple-900 transition-colors ">
                        <!-- Google ikon -->
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
                        </svg>
                        <span>Google</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="mt-auto p-4 border-t border-indigo-400/50">
            <p class="text-sm text-indigo-100/70">Verzió: 1.0.0</p>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">

        <nav class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white sticky top-0 z-50 shadow-xl w-full">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-4">
                        <span class="font-bold text-xl">My Fit Plan</span>
                        <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-white/10 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 flex-grow flex flex-col items-center justify-center">
            @yield('content')
        </main>

        <footer class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white border-t border-white/10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-bold mb-4">Navigáció</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('welcome') }}"
                                    class="hover:text-purple-200 transition-colors duration-300">Főoldal</a></li>
                            <li><a href="{{ route('calorie.tracker') }}"
                                    class="hover:text-purple-200 transition-colors duration-300">Kalória követő</a></li>
                            <li><a href="{{ route('workout.create') }}"
                                    class="hover:text-purple-200 transition-colors duration-300">Edzés tervező</a></li>
                        </ul>
                    </div>

                    <div class="text-center">
                        <h3 class="text-xl font-bold mb-4">Kapcsolat</h3>
                        <div class="space-y-2">
                            <p><i class="fas fa-envelope mr-2"></i>gyorkyd030829@gmail.com</p>
                            <p><i class="fas fa-phone mr-2"></i>+36 1 234 5678</p>
                        </div>
                    </div>

                    <div class="text-center md:text-right">
                        <h3 class="text-xl font-bold mb-4">Kövess minket</h3>
                        <div class="flex justify-center md:justify-end space-x-4">
                            <a href="#"
                                class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#"
                                class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/10 mt-8 pt-6 text-center">
                    <p class="text-sm text-white/80">
                        &copy; {{ date('Y') }} - Az én Laravel alkalmazásom. Minden jog fenntartva.
                    </p>
                </div>
            </div>
        </footer>
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
