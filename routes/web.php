<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/opportunities', function () {
        return Inertia::render('Opportunities', [
            'opportunities' => array(
                1 => array(
                    'id' => 1,
                    'opp' => '23001BMSCPv1',
                    'site' => 'BMS',
                    'owner' => 'CPA',
                    'accountName' => 'Tesla',
                    'sbu' => 'AUT',
                    'projectName' => 'Modela A BMU',
                    'status' => 'Won',
                    'annualRev' => '1000',
                    'ltr' => '7,000',
                    'ltq' => '140',
                    'sop' => 'Q4 2024',
                ),
                2 => array(
                    'id' => 2,
                    'opp' => '23002BMSCPv1',
                    'site' => 'BMS',
                    'owner' => 'CPA',
                    'accountName' => 'Airbus',
                    'sbu' => 'IND',
                    'projectName' => 'Airplane storage controler',
                    'status' => 'Won',
                    'annualRev' => '2500',
                    'ltr' => '14,000',
                    'ltq' => '256',
                    'sop' => 'Q4 2026',
                ),
            )
        ]);
    })->name('opportunities');

    Route::get('/accounts', function () {
        return Inertia::render('Accounts');
    })->name('accounts');

    Route::get('/contacts', function () {
        return Inertia::render('Contacts');
    })->name('contacts');

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';