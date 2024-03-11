<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;	
use App\Http\Controllers\CreateAcc;
use App\Http\Controllers\Mailing;
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
Route::get('/signup', function () { return view('homepage.signup');})->name('signup');
Route::get('/customerlogin', function () { return view('homepage.customer_login');})->name('customer_login');
Route::get('/services', function () { return view('homepage.services');})->name('services');

//Client Back End
Route::post('/customermail',[Mailing::class,'TestMail'] )->name('testMail');




//admin
Route::get('/admin/login', function () { return view('admin.login');})->name('login');
Route::get('/admin', function () { return view('admin.index');})->name('index');

Route::get('/admin/admin_account', function () { return view('admin.admin_acc');})->name('admin_acc');
Route::get('/admin/customer_account', function () { return view('admin.customer_acc');})->name('customer_acc');

Route::get('/admin/rooms_reservation', function () { return view('admin.rooms_r');})->name('rooms_r');
Route::get('/admin/pending_reservation', function () { return view('admin.pending_r');})->name('pending_r');
Route::get('/admin/confirmed_reservation', function () { return view('admin.confirmed_r');})->name('confirmed_r');
Route::get('/admin/cancelled_reservation', function () { return view('admin.cancelled_r');})->name('cancelled_r');
Route::get('/admin/completed_reservation', function () { return view('admin.completed_r');})->name('completed_r');
Route::get('/admin/records_reservation', function () { return view('admin.records_r');})->name('records_r');
Route::get('/admin/admin_lockscreen', function () { return view('admin.admin_lockscreen');})->name('admin_lockscreen');
Route::get('/admin/admin_profile', function () { return view('admin.admin_profile');})->name('admin_profile');
Route::get('/admin/log_history', function () { return view('admin.log_history');})->name('log_history');
Route::get('/admin/promos', function () { return view('admin.promos');})->name('promos');

Route::get('/admin/plans_subscription', function () { return view('admin.plans_s');})->name('plans_s');
Route::get('/admin/pending_subscription', function () { return view('admin.pending_s');})->name('pending_s');
Route::get('/admin/active_subscription', function () { return view('admin.active_s');})->name('active_s');
Route::get('/admin/expired_subscription', function () { return view('admin.expired_s');})->name('expired_s');
Route::get('/admin/cancelled_subscription', function () { return view('admin.cancelled_s');})->name('cancelled_s');
Route::get('/admin/records_subscription', function () { return view('admin.records_s');})->name('records_s');
Route::get('/admin/blank', function () { return view('admin.blank');})->name('blank');
Route::get('/admin/time', function () { return view('admin.time');})->name('time');
Route::get('/admin/logout', function () { return view('admin.logout');})->name('logout');


// Admin Controller 
Route::post('/Admin_login',[Login::class,'Admin_login'] )->name('Admin_login');
Route::post('/Admin_lockscreen',[Login::class,'Admin_lockscreen'] )->name('Admin_lockscreen');
Route::post('/CreateAccount',[CreateAcc::class,'CreateAdmin'] )->name('CreateAdmin');


