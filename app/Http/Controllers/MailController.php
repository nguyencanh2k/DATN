<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mail;
use App\Slider;
use App\CatePost;
use Session;
use App\Http\Requests;
use App\Product;
use Carbon\Carbon;
use App\CategoryProductModel;
use App\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class MailController extends Controller
{
    public function quen_mat_khau(Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        //seo 
        $meta_desc = "Quên mật khẩu"; 
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_order','asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(10)->get();
        $all_product2 = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'asc')->limit(16)->get();
        $all_product3 = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->limit(12)->get();
        $cate_pro_tabs = CategoryProductModel::where('category_status','0')->orderby('category_id','asc')->get(); 
        return view('pages.checkout.forget_pass')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('all_product2',$all_product2)->with('all_product3',$all_product3)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);
    }
    public function recover_pass(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu".' '.$now;
        $customer = Customer::where('customer_email', '=', $data['email_account'])->get();
        foreach($customer as $key => $value){
            $customer_id = $value->customer_id;
        }
        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('error', 'Email hiện chưa được đăng ký');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();
                //send mail
                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']);
                Mail::send('pages.checkout.forget_pass_notify',['data'=>$data], function($message) use ($title_mail,$data){

                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'])->subject($title_mail);//send from this mail
                });
                return redirect()->back()->with('message', 'Vui lòng kiểm tra lại email để lấy lại mật khẩu');
            }
        }

        
    }
    public function update_new_pass(Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        //seo 
        $meta_desc = "Quên mật khẩu"; 
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_order','asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(10)->get();
        $all_product2 = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'asc')->limit(16)->get();
        $all_product3 = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->limit(12)->get();
        $cate_pro_tabs = CategoryProductModel::where('category_status','0')->orderby('category_id','asc')->get(); 
        return view('pages.checkout.new_pass')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('all_product2',$all_product2)->with('all_product3',$all_product3)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);
    }
    public function reset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email', '=', $data['email'])->where('customer_token', '=', $data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach($customer as $key => $cus){
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Cập nhật mật khẩu thành công. Vui lòng đăng nhập lại');
        }else{
            return redirect('quen-mat-khau')->with('error', 'Link đã hết hạn');
        }

    }
}
