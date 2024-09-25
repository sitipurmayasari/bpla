<?php

use App\Http\Controllers\PartisipanController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Livewire\ManageUser;
use App\Http\Livewire\Dashboards;

Route::redirect('/', 'login');


Route::group(['middleware' => ['auth:sanctum','verified']], function () {
    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::get('/home', Dashboards::class)->name('dashboard');
    Route::get('/home', Dashboards::class)->name('home');
   
});
