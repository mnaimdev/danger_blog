<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'welcome']);
Route::get('/about', [FrontendController::class, 'about']);
Route::get('/contact', [FrontendController::class, 'contact']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// User
Route::get('/users', [UserController::class, 'users'])->name('user');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/photo', [UserController::class, 'update_photo'])->name('update.photo');


// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');


// Tag
Route::get('/tag', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');


// Role Manager
// Route::get('/role', [RoleController::class, 'role'])->name('role');
// Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
// Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');


Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
