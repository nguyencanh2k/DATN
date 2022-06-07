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
use App\CategoryProductModel;
use App\Brand;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        //seo 
        $meta_desc = "Watch store - Kinh doanh đồng hồ"; 
        $meta_keywords = "đồng hồ, dong ho";
        $meta_title = "Đồng hồ chính hãng";
        $url_canonical = $request->url();
        //--seo

        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(10)->get();
        $all_product2 = DB::table('tbl_product')->where('product_status','0')->orderby('product_price', 'asc')->limit(10)->get();
        $all_product3 = DB::table('tbl_product')->where('product_status','0')->orderby('product_views', 'desc')->limit(10)->get();
        $cate_pro_tabs = CategoryProductModel::where('category_status','0')->orderby('category_id','asc')->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with(
        'all_product2',$all_product2)->with('all_product3',$all_product3)->with('meta_desc',$meta_desc)->with(
        'meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with(
        'slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);
    }
    public function search(Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
       //$keywords = $request->keywords_submit;
       $keywords = $_GET['keywords_submit'];  

       $search_product = Product::where('product_name','like','%'.$keywords.'%')->paginate(12)->appends(request()->query());
       $search_product->appends(['keywords_submit' => $keywords]);
       $count_prd = count($search_product);

       return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with(
           'meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with(
            'category_post',$category_post)->with('keywords',$keywords)->with('count_prd',$count_prd);

    }
    public function send_mail(){
        //send mail
               $to_name = "Guest";
               $to_email = "nguyencanh932000@gmail.com";//send to this email
              
            
               $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
               
               Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

                   $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
                   $message->from($to_email,$to_name);//send from this mail
               });
               // return redirect('/')->with('message','');
               //--send mail
    }
    public function error_page(){
        return view('errors.404');
    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative; margin-top: 40px;">';
            foreach($product as $key => $val){
                $output.='
                <li class="li_search_ajax p-2"><a href="#" style="color: black">'.$val->product_name.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }
}
