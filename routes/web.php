<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemReceiveController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('template', function () {
    return view('dashboard');
});

Auth::routes();


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

/*------------------------------------------
--------------------------------------------
All Manager Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


Route::middleware(['auth'])->group(function () {
    Route::get('groups/list', [GroupController::class, 'getGroups'])->name('groups.list');
    Route::get('groups', [GroupController::class, 'index'])->name('groups.index');
    Route::post('groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::delete('groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
    Route::post('getSearchGroups', [GroupController::class, 'getSearchGroups'])->name('groups.select');
    Route::post('groups/select-groups', [GroupController::class, 'getSelectGroups'])->name('groups.select-groups');

    Route::get('types/list', [TypeController::class, 'getTypes'])->name('types.list');
    Route::resource('types', TypeController::class);
    Route::post('getSearchTypes', [TypeController::class, 'getSearchTypes'])->name('types.select');

    Route::get('products/list', [ProductController::class, 'getProducts'])->name('products.list');
    Route::post('products/select-products', [ProductController::class, 'getSelectProducts'])->name('products.select-products');
    Route::get('products/{id}/quantities', [ProductController::class, 'getQuantities'])->name('products.quantities');
    Route::resource('products', ProductController::class);

    Route::get('item-receives/list', [ItemReceiveController::class, 'getItemReceive'])->name('item-receives.list');
    Route::resource('item-receives', ItemReceiveController::class);
});
