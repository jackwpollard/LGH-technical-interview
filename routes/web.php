<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Report;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', Report::class);