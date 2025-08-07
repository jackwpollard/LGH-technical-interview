<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Report;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', Report::class);
Route::get('/report/csv', [Report::class, 'downloadCSV'])->name('download-report-csv');