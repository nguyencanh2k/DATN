<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Customer;
use App\CatePost;
use App\CategoryProductModel;
use App\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
class CustomerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_customer(){
        $this->AuthLogin();
        $all_customer_ad = Customer::orderBy('customer_id','DESC')->get();
        return view('admin.customers.all_customer')->with(compact('all_customer_ad'));
    }
    public function unactive_customer($customer_id){
        $this->AuthLogin();
        Customer::where('customer_id',$customer_id)->update(['customer_status'=>1]);
        Toastr::success('Khóa tài khoản thành công', 'Thành công');
        return Redirect::to('all-customer');
    }
    public function active_customer($customer_id){
        $this->AuthLogin();
        Customer::where('customer_id',$customer_id)->update(['customer_status'=>0]);
        Toastr::success('Kích hoạt tài khoản thành công', 'Thành công');
        return Redirect::to('all-customer');
    }
    public function chi_tiet_tai_khoan(Request $request, $customer_id){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
        $profile_customer = Customer::where('customer_id',$customer_id)->get();
        //seo 
        $meta_desc = 'Chi tiết tài khoản'; 
        $meta_keywords = 'Chi tiết tài khoản'; 
        $meta_title = 'Chi tiết tài khoản'; 
        $url_canonical = $request->url();
        //--seo
        return view('pages.customer.profile_customer')->with('category',$cate_product)->with('brand',$brand_product)->with(
            'category_post',$category_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with(
            'meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('profile_customer', $profile_customer);
    }
    public function cap_nhat_tai_khoan(Request $request, $customer_id){
        $data = $request->all();
        $customer = Customer::find($customer_id);
        
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_email = $data['customer_email'];
        $customer->save();
        Session::put('message','Cập nhật thông tin thành công');
        return redirect()->back();
    }
    public function doi_mat_khau(Request $request, $customer_id){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
        $change_password_cus = Customer::where('customer_id',$customer_id)->get();
        //seo 
        $meta_desc = 'Chi tiết tài khoản'; 
        $meta_keywords = 'Chi tiết tài khoản'; 
        $meta_title = 'Chi tiết tài khoản'; 
        $url_canonical = $request->url();
        //--seo
        return view('pages.customer.change_password')->with('category',$cate_product)->with('brand',$brand_product)->with(
            'category_post',$category_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with(
            'meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('change_password_cus',$change_password_cus);
    }
    public function cap_nhat_mat_khau(Request $request, $customer_id){
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password',
        ],
        [
            'confirm_password.same'=>'Mật khẩu mới và mật khẩu xác nhận không khớp',
        ]
    );
        $current_cus = Customer::find($customer_id);
        if(md5($request->old_password) != $current_cus->customer_password){
            Session::put('error','Sai mật khẩu cũ');
            return redirect()->back();
        }elseif(md5($request->old_password) == md5($request->new_password)){
            Session::put('error','Mật khẩu mới phải khác mật khẩu cũ');
            return redirect()->back();
        }else{
            $current_cus->customer_password = (md5($request->new_password));
            $current_cus->save();
            Session::put('message','Cập nhật mật khẩu thành công');
            return redirect()->back();
        }
    }
}
