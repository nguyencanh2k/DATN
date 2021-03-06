<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Cart;
use App\CatePost;
use App\Product;
use App\CategoryProductModel;
use App\Brand;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;

session_start();
class CartController extends Controller
{
    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $val['session_id'],
                        'product_name' => $val['product_name'],
                        'product_id' => $val['product_id'],
                        'product_image' => $val['product_image'],
                        'product_quantity' => $val['product_quantity'],
                        'product_qty' => $val['product_qty']+ $data['cart_product_qty'],
                        'product_price' => $val['product_price'],
                    );
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }   
    public function gio_hang(Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        //seo 
        
       $meta_desc = "Gi??? h??ng c???a b???n"; 
       $meta_keywords = "Gi??? h??ng Ajax";
       $meta_title = "Gi??? h??ng Ajax";
       $url_canonical = $request->url();
       //--seo
       $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
       $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();

       return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
   }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','X??a s???n ph???m th??nh c??ng');

        }else{
            return redirect()->back()->with('message','X??a s???n ph???m th???t b???i');
        }

    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $message.=''.$i.') C???p nh???t s??? l?????ng :'.$cart[$session]['product_name'].' th??nh c??ng<br>';

                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.=''.$i.') C???p nh???t s??? l?????ng :'.$cart[$session]['product_name'].' th???t b???i do kho kh??ng ????? s??? l?????ng<br>';
                    }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','C???p nh???t s??? l?????ng th???t b???i');
        }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','X??a s???n ph???m trong gi??? th??nh c??ng');
        }
    }
    public function check_coupon(Request $request){
        $data = $request->all();
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if(Session::get('customer_id')){
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->where('coupon_used', 'LIKE', '%'.Session::get('customer_id').'%')->first();
            if($coupon){
                return redirect()->back()->with('error','M?? gi???m gi?? ???? ???????c s??? d???ng tr?????c ????. Vui l??ng nh???p m?? kh??c');
            }else{
                $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable==0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,
        
                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,
        
                                );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Th??m m?? gi???m gi?? th??nh c??ng');
                    }
        
                }else{
                    return redirect()->back()->with('error','M?? gi???m gi?? kh??ng ????ng ho???c ???? h???t h???n s??? d???ng');
                }
            }
            //neu chua dang nhap
        }else{
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
    
                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
    
                            );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('message','Th??m m?? gi???m gi?? th??nh c??ng');
                }
    
            }else{
                return redirect()->back()->with('error','M?? gi???m gi?? kh??ng ????ng ho???c ???? h???t h???n s??? d???ng');
            }
        }
        
    } 
    public function show_cart_menu(){
        $cart = count(Session::get('cart'));
        echo $cart;
    }  
    public function click_cart_mini(){
        $cart = count(Session::get('cart'));
        $output = '';
        if($cart>0){
            $total=0;
            $output.='<ul>';
            foreach(Session::get('cart') as $key => $value){
                $total+= $value['product_price']*$value['product_qty'];
                $output.=' <li class="single-shopping-cart">
                                <div class="shopping-cart-img">
                                    <a href=""><img alt="" src="'.asset('public/uploads/product/'.$value['product_image']).'" /></a>
                                    <span class="product-quantity">'.$value['product_qty'].'</span>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="">'.$value['product_name'].'</a></h4>
                                    <span>'.number_format($value['product_price']*$value['product_qty'],0,',','.').' ??</span>
                                    <div class="shopping-cart-delete">
                                        <a href="'.url('/del-product/'.$value['session_id']).'" class="cart_quantity_delete"><i class="ion-android-cancel"></i></a>
                                    </div>
                                </div>
                            </li>';
            }
            
            $output.='</ul>
                    <div class="shopping-cart-total">
                        <h4 class="shop-total">T???ng : <span>'.number_format($total,0,',','.').'??</span></h4>
                    </div>
                    <div class="shopping-cart-btn text-center">
                        <a class="default-btn" href="'.url('/gio-hang').'">Xem gi??? h??ng</a>
                    </div>';
        }
        else{
            $output.='
                    <div class="shopping-cart-total">
                        <h4 class="shop-total text-center">Gi??? h??ng tr???ng</h4>
                    </div>';
        }
        echo $output;
    }  
    
}
