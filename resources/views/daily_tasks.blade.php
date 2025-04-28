@extends('layouts.app')

@section('content')

    <body
        class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
        @include('partials.flash-messages')
        <div class="container mx-auto p-2 sm:p-4 lg:p-6 max-w-4xl">
            <div
                class="backdrop-blur-xl bg-white/80 dark:bg-gray-900/90 rounded-2xl shadow-xl p-4 sm:p-6 transition-all duration-300 hover:shadow-2xl">

                <!-- Header Section -->
                <div class="mb-4 sm:mb-6 text-center space-y-2 sm:space-y-3">
                    <h1
                        class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-purple-600 to-blue-500 bg-clip-text text-transparent dark:from-teal-400 dark:to-blue-400">
                        Napi Teendők
                    </h1>

                    <!-- Date Navigation -->
                    <div class="flex items-center justify-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                        <a href="{{ route('daily-tasks.index', ['date' => \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d')]) }}"
                            class="p-2 sm:p-2.5 rounded-full bg-white/90 dark:bg-gray-800/90 shadow-md hover:shadow-lg transition-all duration-200 hover:-translate-x-0.5 active:scale-95">
                            <i class="fa-solid fa-chevron-left text-purple-600 dark:text-teal-400 text-sm sm:text-base"></i>
                        </a>

                        <div
                            class="px-4 py-2 sm:px-5 sm:py-2.5 bg-white/90 dark:bg-gray-800/90 rounded-full shadow-inner border border-gray-100 dark:border-gray-700">
                            <span class="text-base sm:text-lg font-semibold text-purple-900 dark:text-blue-200">
                                {{ $date }}
                            </span>
                        </div>

                        <a href="{{ route('daily-tasks.index', ['date' => \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d')]) }}"
                            class="p-2 sm:p-2.5 rounded-full bg-white/90 dark:bg-gray-800/90 shadow-md hover:shadow-lg transition-all duration-200 hover:translate-x-0.5 active:scale-95">
                            <i
                                class="fa-solid fa-chevron-right text-purple-600 dark:text-teal-400 text-sm sm:text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- Main Form -->
                <form action="{{ route('daily-tasks.store') }}" method="POST" class="space-y-3 sm:space-y-4">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">

                    <!-- Kártyák konténere (itt lesz a drag & drop) -->
                    <div id="taskList" class="flex flex-col gap-3">
                        @foreach ($tasks as $index => $task)
                            <div
                                class="group bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-3 flex items-center justify-between">

                                <!-- Bal oldal: checkbox + textarea -->
                                <div class="flex items-start gap-2 sm:gap-3 w-full">
                                    <!-- Checkbox -->
                                    <div class="flex items-center justify-center pt-1">
                                        <input type="checkbox" name="tasks[{{ $index }}][completed]" value="1"
                                            @if ($task->completed) checked @endif
                                            class="h-5 w-5 rounded border-gray-300/80 text-purple-600 dark:text-teal-400 focus:ring-2 focus:ring-purple-500/50 dark:focus:ring-teal-400/50 cursor-pointer transition-colors duration-150"
                                            onchange="markUnsavedChanges()">
                                    </div>

                                    <textarea name="tasks[{{ $index }}][task]"
                                        class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-100 placeholder-gray-400/80 dark:placeholder-gray-500 text-sm sm:text-base
                                           resize-none overflow-hidden"
                                        rows="1" oninput="autoResize(this); markUnsavedChanges()" placeholder="Írd ide a teendőt...">{{ $task->task }}</textarea>
                                </div>

                                <div class="flex items-center gap-3 ml-2 sm:ml-4">
                                    <!-- Törlés gomb -->
                                    <button type="button" onclick="removeRow(this)"
                                        class="text-red-400 hover:text-red-600 dark:text-red-500 dark:hover:text-red-400 transition-colors duration-150">
                                        <i class="fa-solid fa-trash-can text-sm sm:text-base"></i>
                                    </button>

                                    <!-- Drag handle -->
                                    <i
                                        class="fa-solid fa-grip-lines text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400 cursor-move transition-colors duration-150"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-between mt-4 sm:mt-6">
                        <button type="button" onclick="addNewRow()"
                            class="order-2 sm:order-1 w-full sm:w-auto px-4 py-2.5 bg-white/90 dark:bg-gray-800/90 shadow-md hover:shadow-lg rounded-xl text-purple-600 dark:text-teal-400 font-medium transition-all duration-200 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-plus text-sm"></i>
                            <span>Új teendő</span>
                        </button>

                        <button type="submit"
                            class="order-1 sm:order-2 w-full sm:w-auto px-5 py-3 bg-gradient-to-r from-purple-600 to-blue-500 dark:from-teal-500 dark:to-blue-600 shadow-md hover:shadow-lg rounded-xl text-white font-medium transition-all duration-200 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                            <span>Mentés</span>
                            <span id="unsavedDot" class="w-2 h-2 bg-blue-200 rounded-full animate-pulse hidden"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

        <script>
            let rowCount = {{ count($tasks) }};
            let hasUnsavedChanges = false;

            function markUnsavedChanges() {
                if (!hasUnsavedChanges) {
                    hasUnsavedChanges = true;
                    document.getElementById('unsavedDot').classList.remove('hidden');
                    document.querySelector('button[type="submit"]').classList.add('animate-pulse');
                }
            }

            function autoResize(textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
            }

            function addNewRow() {
                const taskList = document.getElementById('taskList');
                const newDiv = document.createElement('div');
                newDiv.className =
                    "group bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-3 flex items-center justify-between";

                newDiv.innerHTML = `
                <div class="flex items-start gap-2 sm:gap-3 w-full">
                    <div class="flex items-center justify-center pt-1">
                        <input type="checkbox"
                               name="tasks[${rowCount}][completed]"
                               value="1"
                               class="h-5 w-5 rounded border-gray-300/80 text-purple-600 dark:text-teal-400 focus:ring-2 focus:ring-purple-500/50 cursor-pointer"
                               onchange="markUnsavedChanges()">
                    </div>
                    <textarea
                        name="tasks[${rowCount}][task]"
                        class="w-full bg-transparent border-none focus:ring-0 text-gray-800 dark:text-gray-100 placeholder-gray-400/80 text-sm sm:text-base
                               resize-none overflow-hidden"
                        rows="1"
                        oninput="autoResize(this); markUnsavedChanges()"
                        placeholder="Írd ide a teendőt..."
                        required></textarea>
                </div>
                <div class="flex items-center gap-3 ml-2 sm:ml-4">
                    <button type="button" onclick="removeRow(this)"
                            class="text-red-400 hover:text-red-600 dark:text-red-500 dark:hover:text-red-400 transition-colors duration-150">
                        <i class="fa-solid fa-trash-can text-sm sm:text-base"></i>
                    </button>
                    <i class="fa-solid fa-grip-lines text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400 cursor-move transition-colors duration-150"></i>
                </div>
            `;

                taskList.appendChild(newDiv);
                rowCount++;
                markUnsavedChanges();

                const textarea = newDiv.querySelector('textarea');
                autoResize(textarea);
                textarea.focus();
                newDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            function removeRow(button) {
                const card = button.closest('div.group');
                card.classList.add('animate-fade-out');
                setTimeout(() => card.remove(), 300);
                markUnsavedChanges();
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('textarea').forEach(autoResize);

                const taskList = document.getElementById('taskList');
                Sortable.create(taskList, {
                    handle: '.cursor-move',
                    animation: 150,
                    onEnd: function(evt) {
                        markUnsavedChanges();
                    }
                });
            });
        </script>
    </body>
@endsection
