<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//HomePage
Route::get('/', function () { return view('homepage.index');})->name('home');
Route::get('/aboutus', function () {return view('homepage.about');})->name('about');
Route::get('/contactus', function () { return view('homepage.contact');})->name('contact');
Route::get('/reservation', function () { return view('homepage.reservation');})->name('reservation');