<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ordersController;

use App\Http\Controllers\admincontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\user;

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
Route::middleware('auth')->group(function(){
    if(Gate::denies('isadmin')){
Route::resource('category',CategoryController::class);
Route::resource('products', productsController::class);
}else{
    return response('Only admin can access this page',200);
}
});


//Admin
Route::get('adminRegister',[admincontroller::class,'adminRegister'])->name('adminRegister');
Route::post('adminRegister',[admincontroller::class,'adminStore'])->name('adminStore');
Route::get('adminLogin',[admincontroller::class,'adminLogin'])->name('adminLogin');
Route::post('LoginIn',[admincontroller::class,'LoginIn'])->name('LoginIn');
Route::get('logout', [admincontroller::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){
    if(Gate::denies('isuser')){
    Route::get('index',[indexcontroller::class,'index'])->name('index');
}else{
    return response('Only admin can',200);
}
});
//User
Route::get('userLogin',[usercontroller::class,'userLogin'])->name('userLogin');
Route::get('userRegister',[usercontroller::class,'userRegister'])->name('userRegister');
Route::post('userRegister',[usercontroller::class,'userStore'])->name('userStore');
Route::post('LoginIn',[usercontroller::class,'LoginIn'])->name('LoginIn');
Route::get('logout', [usercontroller::class, 'logout'])->name('logout');

//forgot password
Route::get('forgetPassword', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forgetPassword', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('resetPassword/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('resetPassword', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//shopping
Route::get('shop', [shopController::class, 'index'])->name('shop'); 
Route::get('cart', [shopController::class, 'cartList'])->name('cart.list');
Route::get('cart/{id}', [shopController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [shopController::class, 'updateCart'])->name('cartupdate');
Route::get('remove/{id}', [shopController::class, 'removeCart']);
Route::post('clear', [shopController::class, 'clearAllCart'])->name('cart.clear'); 


//details
Route::get('productDetails/{id}', [DetailsController::class, 'productDetails'])->name('productDetails');  


//Orders
Route::get('/orderManage', [ordersController ::class, 'orders'])->name('orderManage'); 
Route::get('/order_details', [ordersController ::class, 'order_details'])->name('order_details'); 