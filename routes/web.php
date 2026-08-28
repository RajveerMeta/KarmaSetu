<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/causes', function () {
    return view('causes.index');
});

Route::get('/events', function () { 
    $events = require app_path('Data/events.php');
    return view('events.index', compact('events')); 
});

Route::get('/events/{id}', function ($id) {
    $events = require app_path('Data/events.php');

    $event = collect($events)->firstWhere('id', (int) $id);

    abort_unless($event, 404);

    return view('events.show', compact('event'));
})->name('events.show');

Route::get('/ngos', function () { 
    $ngos = require app_path('Data/ngos.php');

    return view('ngos.index', compact('ngos')); 
});

Route::get('/ngos/{id}', function ($id) {
    $ngos = require app_path('Data/ngos.php');

    $ngo = collect($ngos)->firstWhere('id', (int) $id);

    abort_unless($ngo, 404);

    return view('ngos.show', compact('ngo'));
})->name('ngos.show'); 

Route::get('/contribute/{id}', function ($id) {
    $ngos = require app_path('Data/ngos.php');

    $ngo = collect($ngos)->firstWhere('id', (int) $id);

    abort_unless($ngo, 404);

    return view('contribute.show', compact('ngo'));
})->name('contribute.show');

Route::get('/about', function () {
    return view('about');
});
