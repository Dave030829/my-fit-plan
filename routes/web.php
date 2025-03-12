<?php
use App\Http\Controllers\FoodDiaryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutDayController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyTaskController;

/*
|--------------------------------------------------------------------------
| Nyilvános útvonalak (regisztráció, bejelentkezés, Google OAuth)
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegistrationController::class, 'create'])->name('register.create');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('welcome');
})->name('logout');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Kezdőlap, vendégoldal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Edzésnapok
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/workout/create', [WorkoutDayController::class, 'create'])->name('workout.create');
    Route::post('/workout/store', [WorkoutDayController::class, 'store'])->name('workout.store');
});
/*
|--------------------------------------------------------------------------
| Kalória-követő (Foods)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/calorie-tracker', [FoodController::class, 'index'])->name('calorie.tracker');

    Route::get('/foods/search', [FoodController::class, 'searchAjax'])->name('foods.search');

    Route::get('/foods/autocomplete', [FoodController::class, 'autocomplete'])->name('foods.autocomplete');

    Route::resource('foods', FoodController::class)->except(['show']);

});
/*
|--------------------------------------------------------------------------
| Felhasználói profil (auth middleware-rel védve)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/food-diary', [FoodDiaryController::class, 'index'])->name('foodDiary.index');
    Route::post('/food-diary', [FoodDiaryController::class, 'store'])->name('foodDiary.store');
    Route::delete('/food-diary/{id}', [FoodDiaryController::class, 'destroy'])->name('foodDiary.destroy');
});

Route::patch('/food-diary/{id}', [FoodDiaryController::class, 'update'])->name('foodDiary.update');

Route::get('/calorie-calculator', function () {
    return view('calorie_calculator');
})->name('calorie.calculator');

Route::post('/profile/goal/update', [ProfileController::class, 'updateGoal'])
    ->name('profile.goal.update')
    ->middleware('auth');





Route::middleware(['auth'])->group(function () {
    Route::get('daily-tasks', [DailyTaskController::class, 'index'])
        ->name('daily-tasks.index');
    Route::post('daily-tasks', [DailyTaskController::class, 'store'])
        ->name('daily-tasks.store');
});
