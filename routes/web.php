<?php

use App\Http\Controllers\AdminPanelCotroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//all listings
Route::get('/', [ListingController::class, 'index']);

//
Route::get('/book/create', [ListingController::class, 'create'])->middleware('can:add-book');

//store book
Route::post('/book', [ListingController::class, 'store']);

//single listing
Route::get('/book/{listing}', [ListingController::class, 'show']);

//register
Route::get('/register',[UserController::class, 'register'])->middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store']);

//logout
Route::post('/logout',[UserController::class, 'logout']);

//login form
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');

//login to existing user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//show admin panel
Route::get('/admin', [AdminPanelCotroller::class, 'admin'])->middleware('can:admin-panel');

//give role to user
Route::post('/userhandle', [AdminPanelCotroller::class, 'userhandle']);

//rent a book
Route::post('/rent', [ListingController::class, 'rent']);

//show rent page
Route::get('/myrents', [ListingController::class, 'showrents'])->middleware('can:rent-book');

//rent a book
Route::post('/returnbook', [ListingController::class, 'returnbook']);

//give book
Route::post('/givebook', [ListingController::class, 'givebook']);

//view for all rents
Route::get('/allrents', [ListingController::class, 'allrents'])->middleware('can:all-rents');

//rent a book
Route::post('/blockuser', [AdminPanelCotroller::class, 'userhandle'])->middleware('can:block-user');

//remove book
Route::post('/removebook', [ListingController::class, 'removebook']);
//common routes:
// index - show all items
// show - single item
// create - create new item
// store - store new item
// edit - show form to edit item
// update - update item
// destroy - delete item