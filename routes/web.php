<?php
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
//front-end
Route::get('/', 'HomeController@index');

Route::get('/trang-chu', 'HomeController@index');
Route::get('/404', 'HomeController@error_page');
Route::get('/tim-kiem', 'HomeController@search');
Route::post('/autocomplete-ajax', 'HomeController@autocomplete_ajax');
Route::get('/lien-he', 'HomeController@contact');


//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');
Route::get('/tag/{product_tag}','ProductController@tag');
Route::get('/tat-ca-san-pham','ProductController@tat_ca_san_pham');


//Back-end
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard')->middleware('auth.roles');
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

Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');

Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/quickview','ProductController@quickview');
Route::post('/add-comment','ProductController@add_comment');
Route::get('/all-comment','ProductController@all_comment');
Route::post('/reply-comment','ProductController@reply_comment');
Route::get('/delete-comment/{comment_id}','ProductController@delete_comment');
Route::post('/reply-comment-guest','ProductController@reply_comment_guest');

//User
Route::get('users','UserController@index')->middleware('auth.roles');
Route::get('add-users','UserController@add_users');
Route::post('store-users','UserController@store_users');
Route::post('assign-roles','UserController@assign_roles');
Route::get('edit-user-roles/{admin_id}','UserController@edit_user_roles');
Route::post('update-user-roles/{admin_id}','UserController@update_user_roles');
Route::get('delete-user-roles/{admin_id}','UserController@delete_user_roles');
Route::get('profile-admin/{admin_id}','UserController@profile_admin');

//Customer_Phan admin
Route::get('/all-customer','CustomerController@all_customer');
Route::get('/unactive-customer/{customer_id}','CustomerController@unactive_customer');
Route::get('/active-customer/{customer_id}','CustomerController@active_customer');
//chi tiet tai khoan
Route::get('/chi-tiet-tai-khoan/{customer_id}','CustomerController@chi_tiet_tai_khoan');
Route::post('/cap-nhat-tai-khoan/{customer_id}','CustomerController@cap_nhat_tai_khoan');
Route::get('/doi-mat-khau/{customer_id}','CustomerController@doi_mat_khau');
Route::post('/cap-nhat-mat-khau/{customer_id}','CustomerController@cap_nhat_mat_khau');
//Cart
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
Route::post('/confirm-order','CheckoutController@confirm_order');


//Order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_id}','OrderController@view_order');
Route::post('/update-order-status','OrderController@update_order_status');
Route::get('/history','OrderController@history');
Route::get('/view-history-order/{order_id}','OrderController@view_history_order');
Route::post('/huy-don-hang','OrderController@huy_don_hang');
Route::get('/review-order/{order_id}','OrderController@review_order');
Route::post('/add-review','OrderController@add_review');
Route::get('/all-review','OrderController@all_review');
Route::get('/unactive-review/{review_id}','OrderController@unactive_review');
Route::get('/active-review/{review_id}','OrderController@active_review');

//Send Mail 
Route::get('/quen-mat-khau','MailController@quen_mat_khau');
Route::post('/recover-pass','MailController@recover_pass');
Route::get('/update-new-pass','MailController@update_new_pass');
Route::post('/reset-new-pass','MailController@reset_new_pass');
Route::get('/send-coupon/{coupon_id}','MailController@send_coupon');


//Coupon
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');



//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');


//Authentication roles

Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
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
