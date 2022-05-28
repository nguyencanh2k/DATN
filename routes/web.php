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
Route::get('/tim-kiem', 'HomeController@search');
Route::post('/autocomplete-ajax', 'HomeController@autocomplete_ajax');


//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');
Route::get('/tag/{product_tag}','ProductController@tag');
Route::get('/tat-ca-san-pham','ProductController@tat_ca_san_pham');
Route::post('/load-comment','ProductController@load_comment');
Route::post('/send-comment','ProductController@send_comment');
Route::get('/comment','ProductController@list_comment');
Route::post('/allow-comment','ProductController@allow_comment');
Route::post('/reply-comment','ProductController@reply_comment');
Route::post('/insert-rating','ProductController@insert_rating');

//Back-end
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::post('/filter-by-date', 'AdminController@filter_by_date');
Route::post('/days-order', 'AdminController@days_order');
Route::post('/dashboard-filter', 'AdminController@dashboard_filter');

//category prd
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

Route::post('/product-tabs', 'CategoryProduct@product_tabs');
Route::post('/arrange-category', 'CategoryProduct@arrange_category');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');
Route::post('/arrange-brand','BrandProduct@arrange_brand');


//category post
Route::get('/add-category-post','CategoryPost@add_category_post');
Route::get('/all-category-post','CategoryPost@all_category_post');
Route::post('/save-category-post','CategoryPost@save_category_post');
Route::get('/unactive-category-post/{category_post_id}','CategoryPost@unactive_category_post');
Route::get('/active-category-post/{category_post_id}','CategoryPost@active_category_post');
// Route::get('/danh-muc-bai-viet/{cate_post_slug}','CategoryPost@danh_muc_bai_viet');
Route::get('/edit-category-post/{category_post_id}','CategoryPost@edit_category_post');
Route::post('/update-category-post/{cate_id}','CategoryPost@update_category_post');
Route::get('/delete-category-post/{cate_id}','CategoryPost@delete_category_post');

//post
Route::get('/add-post','PostController@add_post');
Route::get('/all-post','PostController@all_post');
Route::get('/unactive-post/{post_id}','PostController@unactive_post');
Route::get('/active-post/{post_id}','PostController@active_post');
Route::get('/delete-post/{post_id}','PostController@delete_post');
Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::post('/save-post','PostController@save_post');
Route::post('/update-post/{post_id}','PostController@update_post');
//danh muc bai viet home
Route::get('/danh-muc-bai-viet/{post_slug}','PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','PostController@bai_viet');

//Product
// Route::group(['middleware' => 'auth.roles'], function () {
//     Route::get('/add-product','ProductController@add_product');
//     Route::get('/edit-product/{product_id}','ProductController@edit_product');
// });

Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');

Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/quickview','ProductController@quickview');

//User
Route::get('users','UserController@index')->middleware('auth.roles');
Route::get('add-users','UserController@add_users');
Route::post('store-users','UserController@store_users');
Route::post('assign-roles','UserController@assign_roles');
Route::get('impersonate/{admin_id}','UserController@impersonate');
Route::get('impersonate-destroy','UserController@impersonate_destroy');
Route::get('edit-user-roles/{admin_id}','UserController@edit_user_roles');
Route::post('update-user-roles/{admin_id}','UserController@update_user_roles');
Route::get('delete-user-roles/{admin_id}','UserController@delete_user_roles');

//Customer_Phan admin
Route::get('/all-customer-ad','CustomerController@all_customer_ad');
Route::get('/add-customer-ad','CustomerController@add_customer_ad');
Route::post('/save-customer-ad','CustomerController@save_customer_ad');
Route::get('/edit-customer-ad/{post_id}','CustomerController@edit_customer_ad');
Route::post('/update-customer-ad/{customer_id}','CustomerController@update_customer_ad');
Route::get('/delete-customer-ad/{customer_id}','CustomerController@delete_customer_ad');
Route::get('/unactive-customer/{customer_id}','CustomerController@unactive_customer');
Route::get('/active-customer/{customer_id}','CustomerController@active_customer');
//chi tiet tai khoan
Route::get('/chi-tiet-tai-khoan/{customer_id}','CustomerController@chi_tiet_tai_khoan');
Route::post('/cap-nhat-tai-khoan/{customer_id}','CustomerController@cap_nhat_tai_khoan');
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
Route::get('/show-cart','CartController@show_cart_menu');
Route::get('/click-cart-mini','CartController@click_cart_mini');

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
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');
Route::get('/del-fee','CheckoutController@del_fee');


//Order
// Route::get('/manage-order','CheckoutController@manage_order');
// Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::get('/delete-order/{order_code}','OrderController@order_code');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::get('/history','OrderController@history');
Route::get('/view-history-order/{order_code}','OrderController@view_history_order');
Route::post('/huy-don-hang','OrderController@huy_don_hang');

//Send Mail 
Route::get('/send-mail','HomeController@send_mail');
Route::get('/quen-mat-khau','MailController@quen_mat_khau');
Route::post('/recover-pass','MailController@recover_pass');
Route::get('/update-new-pass','MailController@update_new_pass');
Route::post('/reset-new-pass','MailController@reset_new_pass');


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
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

//Gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('/select-gallery','GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
Route::post('/update-gallery','GalleryController@update_gallery');

//momo
Route::post('/momo-payment','CheckoutController@momo_payment');
