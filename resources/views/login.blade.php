@extends('layouts.app')

@section('content')

    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        @include('partials.flash-messages')
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mb-5 mt-5 dark:bg-gray-800 dark:text-gray-100">
            <h1 class="text-2xl font-bold mb-6 text-center">Bejelentkezés</h1>

            <!-- Bejelentkezési űrlap -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- E-mail cím -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300">E-mail cím:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Jelszó -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 dark:text-gray-300">Jelszó:</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- 'Remember me' checkbox -->
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="form-checkbox" />
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Maradjak bejelentkezve</span>
                    </label>
                </div>

                <!-- Bejelentkezés gomb -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:bg-teal-600 hover:dark:bg-teal-800 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Bejelentkezés
                </button>
            </form>

            <div class="flex items-center mt-6">
                <hr class="flex-1 border-gray-300">
                <span class="px-2 text-gray-400">vagy</span>
                <hr class="flex-1 border-gray-300">
            </div>

            <!-- Google belépés gombja -->
            <div class="mt-6">
                <a href="{{ route('auth.google') }}"
                    class="w-full inline-flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 py-2 px-4 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none">
                    <svg viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="#000000">
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
                    <span class="text-gray-700 dark:text-gray-100 font-medium">Bejelentkezés Google-lel</span>
                </a>
            </div>

            <p class="mt-6 text-center text-gray-600">
                Nincs még fiókod?
                <a href="{{ route('register.create') }}"
                    class="text-indigo-600 hover:text-indigo-500 dark:text-teal-600 dark:hover:text-teal-800">
                    Regisztrálj itt
                </a>.
            </p>
        </div>
        @yield('content')
    </body>
@endsection
