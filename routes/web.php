<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;

Route::get('/', function() {
    return redirect()->route('employees.index');
});

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);

// Location API proxies (AJAX)
Route::get('/locations/countries', [LocationController::class, 'countries'])->name('locations.countries');
Route::get('/locations/states/{country}', [LocationController::class, 'states'])->name('locations.states');
Route::get('/locations/cities/{state}', [LocationController::class, 'cities'])->name('locations.cities');
Route::post('/get-states', [EmployeeController::class, 'getStates'])->name('get.states');
Route::post('/get-cities', [EmployeeController::class, 'getCities'])->name('get.cities');

