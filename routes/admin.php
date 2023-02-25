<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LectaureController;
use App\Http\Controllers\Admin\CodeController;




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

define('PAGINATION_COUNT',11);

 Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
 Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
 Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');



/*         start  customer                */
Route::get('/customer/index',[CustomerController::class,'index'])->name('admin.customer.index');
Route::get('/customer/create',[CustomerController::class,'create'])->name('admin.customer.create');
Route::post('/customer/store',[CustomerController::class,'store'])->name('admin.customer.store');
Route::get('/customer/edit/{id}',[CustomerController::class,'edit'])->name('admin.customer.edit');
Route::post('/customer/update/{id}',[CustomerController::class,'update'])->name('admin.customer.update');
Route::get('/customer/delete/{id}',[CustomerController::class,'delete'])->name('admin.customer.delete');
Route::post('/customer/ajax_search',[CustomerController::class,'ajax_search'])->name('admin.customer.ajax_search');


/*           end customer                */

/*           start course                */
Route::get('/course/index',[CourseController::class,'index'])->name('admin.course.index');
Route::get('/course/create',[CourseController::class,'create'])->name('admin.course.create');
Route::post('/course/store',[CourseController::class,'store'])->name('admin.course.store');
Route::get('/course/edit/{id}',[CourseController::class,'edit'])->name('admin.course.edit');
Route::post('/course/update/{id}',[CourseController::class,'update'])->name('admin.course.update');
Route::get('/course/delete/{id}',[CourseController::class,'delete'])->name('admin.course.delete');

/*           end course                */


Route::get('/lectaure/index',[LectaureController::class,'index'])->name('admin.lectaure.index');
Route::get('/lectaure/create',[LectaureController::class,'create'])->name('admin.lectaure.create');
Route::post('/lectaure/store',[LectaureController::class,'store'])->name('admin.lectaure.store');
Route::get('/lectaure/edit/{id}',[LectaureController::class,'edit'])->name('admin.lectaure.edit');
Route::post('/lectaure/update/{id}',[LectaureController::class,'update'])->name('admin.lectaure.update');
Route::get('/lectaure/delete/{id}',[LectaureController::class,'delete'])->name('admin.lectaure.delete');


/*           start code                */
Route::get('/code/index',[CodeController::class,'index'])->name('admin.code.index');
Route::get('/code/create',[CodeController::class,'create'])->name('admin.code.create');
Route::post('/code/store',[CodeController::class,'store'])->name('admin.code.store');
Route::get('/code/edit/{id}',[CodeController::class,'edit'])->name('admin.code.edit');
Route::post('/code/update/{id}',[CodeController::class,'update'])->name('admin.code.update');
Route::get('/code/delete/{id}',[CodeController::class,'delete'])->name('admin.code.delete');
/*           end code                */

/*           update login admin                 */
Route::get('/admin/edit/{id}',[LoginController::class,'editlogin'])->name('admin.login.edit');
Route::post('/admin/update/{id}',[LoginController::class,'updatelogin'])->name('admin.login.update');
/*           update login admin                */
});




Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'guest:admin'],function(){
Route::get('login',[LoginController::class,'show_login_view'])->name('admin.showlogin');
Route::post('login',[LoginController::class,'login'])->name('admin.login');

});







