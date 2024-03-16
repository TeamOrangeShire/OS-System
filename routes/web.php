<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;	
use App\Http\Controllers\CreateAcc;
use App\Http\Controllers\EditAcc;
use App\Http\Controllers\Mailing;
use App\Http\Controllers\AddData;
use App\Http\Controllers\EditData;
use App\Http\Controllers\GetDataViews;
use App\Http\Controllers\Reservation;
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
Route::get('/', [GetDataViews::class, 'GetHomeCookies'])->name('home');
Route::get('/contactus', [GetDataViews::class, 'GetContactCookies'])->name('contact');
Route::get('/reservation', [GetDataViews::class, 'GetReservationCookies'])->name('reservation');
Route::get('/signup', function () { return view('homepage.signup');})->name('signup');
Route::get('/customerlogin', function () { return view('homepage.customer_login');})->name('customer_login');
Route::get('/solutions', [GetDataViews::class, 'GetSolutionsCookies'])->name('solutions');
Route::get('/reservation/book', [GetDataViews::class, 'GetBookCookies'])->name('book');
Route::get('/customer-new-account',[CreateAcc::class, 'SuccessCreateAccount'] )->name('new_account');

//Client Back End
Route::post('/customerverification',[Mailing::class,'CreateAccGoogleVerification'] )->name('customer_verification');
Route::post('/customer-create-account',[CreateAcc::class,'CreateCustomerAcc'] )->name('customer_create_account');
Route::post('/customer-login',[Login::class,'LoginCustomer'] )->name('custom_log');
Route::post('/reserve-date',[Reservation::class,'SelectDate'] )->name('submitDateBook');

//Customer Dashboard
Route::get('/customer/profile',[GetDataViews::class, 'CustomerProfile'] )->name('customerProfile');
Route::get('/customer/subscription',[GetDataViews::class, 'CustomerSubscription'] )->name('customerSubscription');
Route::get('/customer/reservation',[GetDataViews::class, 'CustomerReservation'] )->name('customerReservation');
Route::get('/customer/settings',[GetDataViews::class, 'CustomerSettings'] )->name('customerSettings');
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
// Admin
Route::post('/Admin_login',[Login::class,'Admin_login'] )->name('Admin_login');
Route::post('/Admin_lockscreen',[Login::class,'Admin_lockscreen'] )->name('Admin_lockscreen');
Route::post('/CreateAccount',[CreateAcc::class,'CreateAdmin'] )->name('CreateAdmin');
Route::post('/AdminProfile', [EditAcc::class, 'AdminProfile'])->name('AdminProfile');
Route::post('/EditAdmin',[EditAcc::class,'EditAdmin'] )->name('EditAdmin');
// AddData
Route::post('/AddPromo', [AddData::class, 'AddPromo'])->name('AddPromo');
Route::post('/AddPlan', [AddData::class, 'AddPlan'])->name('AddPlan');
Route::post('/AddRoom', [AddData::class, 'AddRoom'])->name('AddRoom');
Route::post('/AddRate', [AddData::class, 'AddRate'])->name('AddRate');
Route::post('/AddRoomRate', [AddData::class, 'AddRoomRate'])->name('AddRoomRate');
// EditData
Route::post('/EditPromo', [EditData::class, 'EditPromo'])->name('EditPromo');
Route::post('/EditPlan', [EditData::class, 'EditPlan'])->name('EditPlan');
Route::post('/EditRoom', [EditData::class, 'EditRoom'])->name('EditRoom');
Route::post('/EditRate', [EditData::class, 'EditRate'])->name('EditRate');
Route::post('/EditRoomRate', [EditData::class, 'EditRoomRate'])->name('EditRoomRate');
Route::post('/DisableRate', [EditData::class, 'DisableRate'])->name('DisableRate');
Route::post('/EnableRate', [EditData::class, 'EnableRate'])->name('EnableRate');
Route::post('/DisableRoom', [EditData::class, 'DisableRoom'])->name('DisableRoom');
Route::post('/EnableRoom', [EditData::class, 'EnableRoom'])->name('EnableRoom');
Route::post('/DisableRoomRate', [EditData::class, 'DisableRoomRate'])->name('DisableRoomRate');
Route::post('/EnableRoomRate', [EditData::class, 'EnableRoomRate'])->name('EnableRoomRate');
Route::post('/DisablePromo', [EditData::class, 'DisablePromo'])->name('DisablePromo');
Route::post('/EnablePromo', [EditData::class, 'EnablePromo'])->name('EnablePromo');
Route::post('/DisablePlan', [EditData::class, 'DisablePlan'])->name('DisablePlan');
Route::post('/EnablePlan', [EditData::class, 'EnablePlan'])->name('EnablePlan');



