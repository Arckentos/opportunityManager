<?php

use App\Http\Controllers\AccountController;
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
    /**
     * Opportunities
     */
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
    })->name('opportunities.index');

    /**
     * Accounts
     */
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');

    Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');

    Route::get('/accounts/{id}', [AccountController::class, 'edit'])->name('accounts.edit');
    
    Route::post('/accounts/store', [AccountController::class, 'store'])->name('accounts.store');
    
    Route::patch('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');

    /**
     * Contacts
     */
    Route::get('/contacts', function () {
        return Inertia::render('Contacts');
    })->name('contacts.index');

    /**
     * Settings
     */
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';