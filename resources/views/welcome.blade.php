<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözlő oldal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')

    <body class="bg-gradient-to-br from-purple-50 to-indigo-50 min-h-screen flex flex-col">
        <div class="relative flex flex-col items-center justify-center flex-grow text-center py-12 px-4">
            <div class="absolute inset-0 overflow-hidden">
                <svg class="absolute top-0 left-0 w-full h-full opacity-5" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 800 800">
                    <circle cx="200" cy="200" r="120" fill="#8b5cf6" />
                    <circle cx="600" cy="600" r="160" fill="#4f46e5" />
                </svg>
            </div>

            <h1
                class="text-4xl sm:text-6xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Üdvözöllek a Fit Appban!
            </h1>
            <p class="max-w-xl text-gray-600 mb-6 text-lg sm:text-xl">
                Itt mindent megtalálsz az edzésed és az étrended nyomon követéséhez.
                Céljaid eléréséhez pedig legyen a társad a Fit App!
            </p>

            <!-- Gombok, linkek -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('calorie.tracker') }}"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 
                       text-white font-semibold px-8 py-3 rounded-full shadow-xl transition-transform
                       hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-fire mr-2"></i>Kalória követő
                </a>
                <a href="{{ route('workout.create') }}"
                    class="bg-purple-100 text-purple-700 font-semibold px-8 py-3 rounded-full shadow-xl 
                       hover:bg-purple-200 transition-transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-dumbbell mr-2"></i>Edzés tervező
                </a>
            </div>
        </div>

        <div class="bg-white py-8 shadow-inne mb-5">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap gap-6 justify-center">
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-100 p-4 rounded-full mb-3">
                        <i class="fas fa-heartbeat text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700">Egészséges életmód</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Kövesd nyomon kalória-fogyasztásod és maradj fitt!
                    </p>
                </div>
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-100 p-4 rounded-full mb-3">
                        <i class="fas fa-chart-line text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700">Részletes statisztikák</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Ismerd meg az előrehaladásod grafikonokon és diagramokon keresztül.
                    </p>
                </div>
                <div class="flex flex-col items-center w-64 text-center">
                    <div class="bg-purple-100 p-4 rounded-full mb-3">
                        <i class="fas fa-users text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-700">Közösség és motiváció</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Oszd meg eredményeidet és kapj támogatást a fitnesz céljaidhoz.
                    </p>
                </div>
            </div>
        </div>
    </body>
@endsection

</html>
