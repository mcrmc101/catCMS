<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Application;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/admin');
    })->name('dashboard');
});


Route::get('/', [PageController::class, 'showHomePage']);

Route::fallback(function () {
    return app(PageController::class)->showPage(last(request()->segments()));
});
