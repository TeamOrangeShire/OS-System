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


//admin
Route::get('/admin/login', function () { return view('admin.login');})->name('login');
Route::get('/admin', function () { return view('admin.index');})->name('index');
Route::get('/admin/admin_account', function () { return view('admin.admin_acc');})->name('admin_acc');
Route::get('/admin/customer_account', function () { return view('admin.customer_acc');})->name('customer_acc');
Route::get('/admin/blank', function () { return view('admin.blank');})->name('blank');