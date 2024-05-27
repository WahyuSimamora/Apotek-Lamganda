<?php

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
Route::get('/', [App\Http\Controllers\MedicineController::class, 'index'])->name('welcome')->middleware(['role:customer|anonymous']);
Route::get('/medicine/{id}', [App\Http\Controllers\MedicineController::class, 'viewById'])->name('welcome')->middleware(['role:customer|anonymous']);
Route::get('/search', [App\Http\Controllers\MedicineController::class, 'cari'])->name('welcome')->middleware(['role:customer|anonymous']);

// cart
Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('store-cart')->middleware(['role:customer']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart-list')->middleware(['role:customer']);
Route::get('/cart/delete/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart-delete')->middleware(['role:customer']);

// order
Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order-store')->middleware(['role:customer']);
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order-list')->middleware(['role:customer']);
Route::get('/order/{order_id}', [App\Http\Controllers\OrderController::class, 'getDetail'])->name('order-list')->middleware(['role:customer']);
Route::get('/order/reject/{order_id}', [App\Http\Controllers\OrderController::class, 'rejectOrderByCustomer'])->name('order-list')->middleware(['role:customer']);

// status order
Route::get('/status', [App\Http\Controllers\OrderController::class, 'getHistoryOrder'])->name('history-list')->middleware(['role:customer']);
Route::get('/status/{order_id}', [App\Http\Controllers\OrderController::class, 'getDetailHistory'])->name('history-list')->middleware(['role:customer']);

// profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware(['role:customer']);
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile')->middleware(['role:customer']);
Route::get('/profile/update/{user_id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile')->middleware(['role:customer']);
Route::get('/about-us', [App\Http\Controllers\ProfileController::class, 'aboutUs'])->name('about-us')->middleware(['role:customer']);


// Auth::routes();
// Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']); 
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('register', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::post('logout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('logout');
Route::get('/404', [App\Http\Controllers\CustomAuthController::class, 'notFound'])->name('404');

// admin route
// order management
Route::get('/dashboard', [App\Http\Controllers\DashboardAdminController::class, 'index'])->middleware(['role:admin|karyawan']);
Route::get('dashboard/404', [App\Http\Controllers\CustomAuthController::class, 'notFoundAdmin'])->name('404admin');
Route::get('/dashboard/order-management', [App\Http\Controllers\DashboardAdminController::class, 'orders'])->name('order-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/search', [App\Http\Controllers\DashboardAdminController::class, 'searchOrder'])->name('order-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/approve/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'approveOrder'])->name('order-approve')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/reject/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'rejectOrder'])->name('order-reject')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/delete/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'deleteOrder'])->name('delete-approve')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/taken/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'takenOrder'])->name('order-taken')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-management/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'getDetailOrder'])->name('order-management')->middleware(['role:admin|karyawan']);

// product management
Route::get('/dashboard/medicine-management', [App\Http\Controllers\DashboardAdminController::class, 'getMedicines'])->name('medicine-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/medicine-management/create', [App\Http\Controllers\DashboardAdminController::class, 'createMedicine'])->name('medicine-management')->middleware(['role:admin|karyawan']);
Route::post('/dashboard/medicine-management/store', [App\Http\Controllers\DashboardAdminController::class, 'storeMedicine'])->name('medicine-store')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/medicine-management/delete/{medicine_id}', [App\Http\Controllers\DashboardAdminController::class, 'deleteMedicine'])->name('medicine-delete')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/medicine-management/search', [App\Http\Controllers\DashboardAdminController::class, 'searchMedicine'])->name('medicine-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/medicine-management/{medicine_id}', [App\Http\Controllers\DashboardAdminController::class, 'editMedicine'])->name('medicine-management')->middleware(['role:admin|karyawan']);
Route::put('/dashboard/medicine-management/update/{medicine_id}', [App\Http\Controllers\DashboardAdminController::class, 'updateMedicine'])->name('medicine-management')->middleware(['role:admin|karyawan']);

// user management
Route::get('/dashboard/user-management', [App\Http\Controllers\DashboardAdminController::class, 'getUsers'])->name('user-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/user-management/create', [App\Http\Controllers\DashboardAdminController::class, 'createUser'])->name('user-management')->middleware(['role:admin|karyawan']);
Route::post('/dashboard/user-management/store', [App\Http\Controllers\DashboardAdminController::class, 'storeUser'])->name('user-store')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/user-management/delete/{user_id}', [App\Http\Controllers\DashboardAdminController::class, 'deleteUser'])->name('user-delete')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/user-management/search', [App\Http\Controllers\DashboardAdminController::class, 'searchUser'])->name('user-management')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/user-management/{user_id}', [App\Http\Controllers\DashboardAdminController::class, 'editUser'])->name('user-management')->middleware(['role:admin|karyawan']);
Route::put('/dashboard/user-management/update/{user_id}', [App\Http\Controllers\DashboardAdminController::class, 'updateUser'])->name('user-management')->middleware(['role:admin|karyawan']);

// profile
Route::get('/dashboard/profile', [App\Http\Controllers\ProfileController::class, 'admin'])->name('profile-admin')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile-admin')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/profile/update/{user_id}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile-admin')->middleware(['role:admin|karyawan']);

// order history
Route::get('/dashboard/order-history', [App\Http\Controllers\DashboardAdminController::class, 'orderHistory'])->name('order-history')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-history/search', [App\Http\Controllers\DashboardAdminController::class, 'searchHistory'])->name('order-history')->middleware(['role:admin|karyawan']);
Route::get('/dashboard/order-history/{order_id}', [App\Http\Controllers\DashboardAdminController::class, 'getDetailHistory'])->name('order-history')->middleware(['role:admin|karyawan']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/generate-pdf', [App\Http\Controllers\OrderController::class, 'generatePDF']);
