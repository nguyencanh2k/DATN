<?php

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
//front-end
Route::get('/', 'HomeController@index');

Route::get('/trang-chu', 'HomeController@index');
Route::get('/404', 'HomeController@error_page');
Route::post('/tim-kiem', 'HomeController@search');


//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');

//Back-end
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dashboard', 'AdminController@dashboard');

//category prd
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


//Cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang');
Route::post('/update-cart','CartController@update_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');

//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/confirm-order','CheckoutController@confirm_order');


//Order
// Route::get('/manage-order','CheckoutController@manage_order');
// Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::get('/delete-order/{order_code}','OrderController@order_code');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');

//Send Mail 
Route::get('/send-mail','HomeController@send_mail');


//Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');



//Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');


//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');


//Authentication roles

Route::get('/register-auth','AuthController@register_auth');
Route::post('/register','AuthController@register');