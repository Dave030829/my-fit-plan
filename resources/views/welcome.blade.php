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
                            class="fa-solid fa-calendar-days w-5 h-5 text-gray-500 transition duration-75 
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
                <li>
                    <a href="{{ route('workouts.follow') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-dumbbell w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Edzés követő</span>
                    </a>
                    <a href="{{ route('challenges.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg 
                               dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-bullseye w-5 h-5 text-gray-500 transition duration-75 
                                  dark:text-gray-400 group-hover:text-gray-900 
                                  dark:group-hover:text-white mr-2"></i>
                        <span class="dark:text-gray-300">Kihívások</span>
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
                            class="block px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 
                                   transition-colors text-white dark:bg-teal-400 bg-purple-400">
                            <i class="fas fa-sign-in-alt mr-2"></i> Bejelentkezés
                        </a>
                        <a href="{{ route('register.create') }}"
                            class="block px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 
                                   transition-colors text-white dark:bg-teal-600 bg-purple-600">
                            <i class="fas fa-user-plus mr-2"></i> Regisztráció
                        </a>
                        <a href="{{ route('auth.google') }}"
                            class="flex items-center px-3 py-2 rounded-xl bg-purple-800 hover:bg-purple-900 
                                   transition-colors dark:bg-teal-700 dark:hover:bg-gray-600">
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
                    Verzió: 1.2.0
                </p>
            </div>
        </div>
    </div>

    <!-- Üdvözlő oldal tartalma ide jön -->

    <!-- Hero szekció -->
    <section class="relative min-h-[80vh] flex items-center">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center space-y-8 max-w-4xl mx-auto" data-aos="fade-up">
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-teal-400 dark:to-blue-400">
                        My Fit Plan
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Az egyetlen platformod az okos fitnesz tervezéshez, precíz táplálkozáskövetéshez és fenntartható
                    egészségjavuláshoz.
                </p>

                <div class="mt-12 flex flex-col md:flex-row justify-center gap-6">
                    @if (!auth()->check())
                        <a href="{{ route('register.create') }}"
                            class="bg-white text-purple-600 dark:text-teal-600 dark:hover:shadow-teal-500/30 justify-center p-4 rounded-2xl shadow-2xl hover:bg-purple-600 hover:text-white dark:hover:bg-teal-700 transition-all">
                            Indítsd el az utadat →
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-8 py-4 bg-white dark:bg-gray-100 text-gray-900 dark:text-gray-900 rounded-2xl shadow-lg hover:shadow-xl hover:bg-gray-50 dark:hover:bg-gray-200 transition-all">
                            Már tag? Jelentkezz be
                        </a>
                    @else
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('workout.create') }}"
                                class="px-6 py-3 bg-purple-500 dark:bg-teal-500 backdrop-blur-sm text-white rounded-full shadow-lg hover:shadow-xl transition hover:-translate-y-1">
                                🏋️ Edzés tervező
                            </a>
                            <a href="{{ route('calorie.tracker') }}"
                                class="px-6 py-3 bg-purple-500 dark:bg-teal-500 backdrop-blur-sm text-white rounded-full shadow-lg hover:shadow-xl transition hover:-translate-y-1">
                                📊 Étrend követő
                            </a>
                            <a href="{{ route('calorie.calculator') }}"
                                class="px-6 py-3 bg-purple-500 dark:bg-teal-500 backdrop-blur-sm text-white rounded-full shadow-lg hover:shadow-xl transition hover:-translate-y-1">
                                🔢 Makró számoló
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Funkciók szekció -->
    <section class="py-24 bg-gray-50 dark:bg-gray-900 rounded-3xl" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Formáld át fitnesz utadat
                </h2>
                <p class="mt-4 text-gray-600 dark:text-gray-300 text-xl max-w-2xl mx-auto">
                    Fedezd fel az erőteljes eszközöket, amelyek segítenek elérni egészségi céljaidat.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Funkciókártya 1 -->
                <div class="p-8 bg-white dark:bg-gray-800 rounded-[2rem] shadow-lg group" data-aos="fade-up"
                    data-aos-delay="100">
                    <div
                        class="w-20 h-20 bg-purple-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-dumbbell text-3xl text-purple-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Edzéseid követése</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Állítsd össze a neked legmegfelelőbb edzéstervet, és kövesd az előrehaladásodat.
                    </p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="h-1 w-16 bg-purple-600 dark:bg-teal-400 rounded-full"></div>
                    </div>
                </div>

                <!-- Funkciókártya 2 -->
                <div class="p-8 bg-white dark:bg-gray-800 rounded-[2rem] shadow-lg group" data-aos="fade-up"
                    data-aos-delay="200">
                    <div
                        class="w-20 h-20 bg-purple-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-apple-alt text-3xl text-purple-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Táplálkozás követése</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Átfogó ételadatbázisunk segítségével ideális étrendet állíthatsz össze, és követheted a makróidat.
                    </p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="h-1 w-16 bg-purple-600 dark:bg-teal-400 rounded-full"></div>
                    </div>
                </div>

                <!-- Funkciókártya 3 -->
                <div class="p-8 bg-white dark:bg-gray-800 rounded-[2rem] shadow-lg group" data-aos="fade-up"
                    data-aos-delay="300">
                    <div
                        class="w-20 h-20 bg-purple-100 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-list-check text-3xl text-purple-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Napi feladataid</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Jegyezd mindennapi teendőid, hogy mostantól egy edzés se maradjon ki.
                    </p>
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="h-1 w-16 bg-purple-600 dark:bg-teal-400 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Miért válaszd a My Fit Plan-t? (új statisztikákkal) -->
    <section class="py-5 bg-white dark:bg-gray-800 rounded-3xl mt-5" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- Bal oldal tartalom -->
                <div class="space-y-8 bg-purple-200/50 dark:bg-emerald-900/50 shadow-2xl p-5 rounded-2xl"
                    data-aos="fade-right" data-aos-delay="100">
                    <h2 class="text-4xl font-bold text-purple-900 dark:text-white">
                        Miért válaszd a My Fit Plan-t?
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        A My Fit Plan megkönnyíti az utadat a céljaid felé: személyre szabott edzéstervek, pontos
                        kalóriakövetés és naprakész kihívások várnak rád.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mt-12">
                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl text-center shadow-inner">
                            <div class="text-3xl font-bold text-purple-600 dark:text-teal-400">1K+</div>
                            <div class="text-gray-600 dark:text-gray-300 mt-2">Regisztrált felhasználó</div>
                        </div>
                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl text-center shadow-inner">
                            <div class="text-3xl font-bold text-purple-600 dark:text-teal-400">4.9/5</div>
                            <div class="text-gray-600 dark:text-gray-300 mt-2">Átlagos értékelés</div>
                        </div>
                    </div>
                </div>

                <!-- Jobb oldal telefonos mockup (háttér nélkül) -->
                <div class="flex justify-center items-end" data-aos="fade-left" data-aos-delay="200">
                    <img src="/images/myfitplan-mobile.png" alt="My Fit Plan mobil nézet" class="max-w-[240px]" />
                </div>

            </div>
        </div>
    </section>

    <!-- Mindennap új kihívások szekció -->
    <section class="py-5 bg-white dark:bg-gray-800 rounded-3xl mt-5" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- Bal oldal (kihívások képe) -->
                <div class="flex justify-center items-end" data-aos="fade-left" data-aos-delay="100">
                    <img src="/images/challanges-welcomepage.png" alt="My Fit Plan mobil nézet" class="max-w-[220px]" />
                </div>

                <!-- Jobb oldal (kihívások szöveg) -->
                <div class="space-y-8 bg-purple-200/50 dark:bg-emerald-900/50 shadow-2xl p-5 rounded-2xl"
                    data-aos="fade-right" data-aos-delay="200">
                    <h2 class="text-4xl font-bold text-purple-900 dark:text-white">
                        Mindennap új kihívások!
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        Kell egy kis motiváció, hogy tartsd magad a céljaidhoz? Nálunk minden nap új kihívásokkal
                        találkozhatsz.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA szekció -->
    <section
        class="py-24 bg-gradient-to-br from-purple-600 to-indigo-600 dark:from-teal-800 dark:to-cyan-900 mt-5 rounded-3xl mb-5"
        data-aos="fade-up">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-4xl font-bold text-white mb-8">
                    Kezdd el a változást még ma!
                </h2>
                <p class="text-lg text-gray-200 mb-12">
                    Csatlakozz közösségünkhöz, és élvezd a prémium funkciókat 14 napos ingyenes próbaidőszakkal.
                </p>
                <a href="{{ route('register.create') }}"
                    class="px-12 py-4 bg-white text-purple-600 dark:text-teal-600 dark:hover:shadow-teal-500/30 rounded-full text-lg font-semibold shadow-2xl hover:shadow-purple-500/30 hover:-translate-y-1 transition-all">
                    Indítsd el az utadat →
                </a>
            </div>
        </div>
    </section>





    <script src="https://unpkg.com/flowbite@1.6.4/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            offset: 200,
        });
    </script>
@endsection
