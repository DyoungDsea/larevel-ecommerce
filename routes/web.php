<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'] )->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'] )->name('admin.profile');
    Route::post('/admin/store', [AdminController::class, 'AdminProfileStore'] )->name('admin.profile.store');

    Route::get('/admin/change_password', [AdminController::class, 'AdminChangePassword'] )->name('admin.change.password');
    Route::post('/admin/store/password',  [AdminController::class,'StoreChangePassword'])->name('admin.store.password');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'] )->name('admin.logout');
});

Route::middleware(['auth', 'role:vendor'])->group(function (){ 
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'] )->name('vendor.dashboard');

    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'] )->name('vendor.profile');
    Route::post('/vendor/store', [VendorController::class, 'VendorProfileStore'] )->name('vendor.profile.store');

    Route::get('/vendor/change_password', [VendorController::class, 'VendorChangePassword'] )->name('vendor.change.password');
    
    Route::post('/vendor/store/password',  [VendorController::class,'StoreChangePassword'])->name('vendor.store.password');

    Route::get('/vendor/logout', [VendorController::class, 'VendorLogout'] )->name('vendor.logout');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'] )->name('admin.login');
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'] )->name('vendor.login');


//TODO: Brand controller
Route::controller(BrandController::class)->group(function () {
    Route::get('/admin/all/brand', "AllBrand")->name('all.brand');
    Route::get('/admin/add/brand', "AddBrand")->name('add.brand');
    Route::post('/admin/store/brand', "StoreBrand")->name('store.brand');
    Route::get('/admin/edit/brand/{id}', "EditBrand")->name('edit.brand');
    Route::post('/admin/update/brand', "UpdateBrand")->name('update.brand');
    Route::get('/admin/delete/brand/{id}', "DeleteBrand")->name('delete.brand');
});

//TODO: Category controller
Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/all/category', "AllCategory")->name('all.category');
    Route::get('/admin/add/category', "AddCategory")->name('add.category');
    Route::post('/admin/store/category', "StoreCategory")->name('store.category');
    Route::get('/admin/edit/category/{id}', "EditCategory")->name('edit.category');
    Route::post('/admin/update/category', "UpdateCategory")->name('update.category');
    Route::get('/admin/delete/category/{id}', "DeleteCategory")->name('delete.category');
});

