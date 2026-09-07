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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/user/contributions', function () {
    return view('user.contributions');
});

Route::get('/user/contributions/{id}', function ($id) {
    return view('user.contribution-details', ['id' => $id]);
});

Route::get('/user/events', function () {
    $events = require app_path('Data/events.php');
    return view('user.events', compact('events'));
});

Route::get('/user/volunteer-activities', function () {
    return view('user.volunteer-activities');
});

Route::get('/leaderboard', function () {
    return view('leaderboard');
});

Route::get('/user/profile', function () {
    return view('profile');
});
