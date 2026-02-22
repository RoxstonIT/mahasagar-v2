<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomepageController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

// PROMPT FOR ChatGPT : Remember we had created this temperory route for testing the category page? Now we can remove that and create a dynamic route for the category page. So that we can use the same route for all the categories by passing dynamic parameters as required.
Route::get('/national', function () {
    return view('web.category');
});
