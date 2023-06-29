<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LendTypeController;
use App\Http\Controllers\DepartmentController;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $lendChart = new LaravelChart([
            'chart_title' => 'Evolution des synchronisations des attestations digitales par mois',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Department',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_by_period' => 'month',
            'chart_type' => 'pie',
            'chart_color' => '40, 117, 155',
            'chart_height' => '200px',
            'date_format' => 'M',
        ]);

    return view('dashboard', compact('lendChart'));
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('lends', LendController::class);
    Route::resource('lend-types', LendTypeController::class);
    Route::get('lends/{lend}/{state}/update', [LendController::class, 'changeState'])->name('change-state');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
