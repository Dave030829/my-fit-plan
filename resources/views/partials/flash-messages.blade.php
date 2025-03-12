@if (session('success'))
    <div id="flashSuccess"
        class="fixed top-10 left-1/2 w-full max-w-lg px-4 transform -translate-x-1/2 -translate-y-full transition-all duration-500 z-50"
        role="alert" aria-live="assertive">
        <div
            class="p-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 shadow-lg">
            <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400"></i>
            <span class="text-green-700 dark:text-green-300">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error') || $errors->any())
    <div id="flashError"
        class="fixed top-10 left-1/2 w-full max-w-lg px-4 transform -translate-x-1/2 -translate-y-full transition-all duration-500 z-50"
        role="alert" aria-live="assertive">
        <div
            class="p-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-800 rounded-xl flex items-center gap-3 shadow-lg">
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

<style>
    @media (display-mode: standalone) and (max-width: 640px) {

        #flashSuccess,
        #flashError {
            top: calc(env(safe-area-inset-top) + 10px) !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Flash üzenetek azonosítóinak listája
        const flashMessages = ['flashSuccess', 'flashError'];
        flashMessages.forEach(function(id) {
            const element = document.getElementById(id);
            if (element) {
                // Kis késleltetés után csúsztatjuk le az üzenetet
                setTimeout(() => {
                    element.classList.remove('-translate-y-full');
                    element.classList.add('translate-y-0');
                }, 100);

                // 3 másodperc után visszacsúsztatjuk az üzenetet
                setTimeout(() => {
                    element.classList.remove('translate-y-0');
                    element.classList.add('-translate-y-full');
                }, 3100);

                // Az animáció után eltávolítjuk az elemet
                setTimeout(() => {
                    element.remove();
                }, 3600);
            }
        });
    });
</script>
