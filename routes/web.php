<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SslCommerzPaymentController;

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



Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');

//category page
Route::get('view-category',[AdminController::class,'category'])->name('category');

//add category
Route::post('add-category',[AdminController::class,'add_category'])->name('add-category');

//delete category
Route::get('delete-category/{id}',[AdminController::class,'delete_category'])->name('delete-category');

//view products page
Route::get('add-products',[AdminController::class,'view_products'])->name('add-products');

//add products
Route::post('add-products',[AdminController::class,'add_products'])->name('add-products');

//show products
Route::get('show-products',[AdminController::class,'show_products'])->name('show-products');

//delete product
Route::get('delete-product/{id}',[AdminController::class,'delete_product'])->name('delete-product');

//edit product
Route::get('edit-product/{id}',[AdminController::class,'edit_product'])->name('edit-product');

//update product
Route::post('update-product/{id}',[AdminController::class,'update_product'])->name('update-product');

// product details
Route::get('product-details/{id}',[HomeController::class,'product_details'])->name('product-details');
//search product
Route::post('search_product',[HomeController::class,'search_product'])->name('search_product');

//category product
Route::get('category_product/{id}',[HomeController::class,'category_product'])->name('category_product');


//add to cart
Route::post('addtocart/{id}',[HomeController::class,'add_cart'])->name('add-to-cart');

//Show cart
Route::get('show-cart',[HomeController::class,'show_cart'])->name('show-cart');
//test
Route::get('test/{id}',[HomeController::class,'test'])->name('test');
//test
Route::get('showtest',[HomeController::class,'showtest'])->name('test');
//update quantity
Route::get('plusqty/{id}',[HomeController::class,'plusqty'])->name('plusqty');
Route::get('minusqty/{id}',[HomeController::class,'minusqty'])->name('plusqty');
//remove specific product from cart
Route::get('remove_cart/{id}',[HomeController::class,'remove_cart'])->name('remove_cart');

//redirect checkout page
Route::get('checkout',[HomeController::class,'checkout'])->name('checkout');
//product order page
Route::post('order',[HomeController::class,'order'])->name('order');

//customer page
Route::get('customer',[AdminController::class,'customer'])->name('customer');
Route::get('delete_user/{id}',[AdminController::class,'deleteUser'])->name('delete_user');
//stripe post
Route::post('stripe/{price}',[HomeController::class, 'stripePost'])->name('stripe.post');

//order page admin not delivered
Route::get('notdelivered',[AdminController::class,'notdelivered'])->name('order-page');
Route::get('delivered',[AdminController::class,'delivered'])->name('delivered');
Route::get('shipping',[AdminController::class,'shipping'])->name('shipping');
Route::get('toshipping/{id}',[AdminController::class,'toshipping'])->name('toshipping');
Route::get('todelivered/{id}',[AdminController::class,'todelivered'])->name('todelivered');
Route::get('delete_order/{id}',[AdminController::class,'delete_order'])->name('delete_order');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay/{total}', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
