<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Customer;
use App\CatePost;
use DB;
use Session;
use Auth;
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
    public function all_customer_ad(){
        $this->AuthLogin();
        $all_customer_ad = Customer::orderBy('customer_id','DESC')->get();
        return view('admin.customers.all_customer')->with(compact('all_customer_ad'));
    }
    public function add_customer_ad(){
        $this->AuthLogin();
        return view('admin.customers.add_customer');
    }
    public function save_customer_ad(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $user_cus = Customer::where('customer_email', $data['customer_email'])->first();
        if ($user_cus) {
            Toastr::error('Email đã tồn tại', 'Thất bại');
        } else {
            $customer->save();
            Toastr::success('Thêm khách hàng thành công', 'Thành công');
        }
        return Redirect::to('add-customer-ad');
    }
    public function edit_customer_ad($customer_id){
        $this->AuthLogin();
        $edit_customer_ad = Customer::where('customer_id',$customer_id)->get();

        return view('admin.customers.edit_customer')->with('edit_customer_ad', $edit_customer_ad);
    }
    public function update_customer_ad(Request $request, $customer_id){
        $data = $request->all();
        $customer = Customer::find($customer_id);
        
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->save();
        Toastr::success('Cập nhật thông tin khách hàng thành công', 'Thành công');
        return Redirect::to('all-customer-ad');
    }
    public function delete_customer_ad($customer_id){
        $delete_cus = Customer::find($customer_id);
        $delete_cus->delete();
        //Session::put('message','Xóa khách hàng thành công');
        Toastr::success('Xóa khách hàng thành công', 'Thành công');
        return redirect()->back();
    }
    public function unactive_customer($customer_id){
        $this->AuthLogin();
        Customer::where('customer_id',$customer_id)->update(['customer_status'=>1]);
        Toastr::success('Khóa tài khoản thành công', 'Thành công');
        return Redirect::to('all-customer-ad');
    }
    public function active_customer($customer_id){
        $this->AuthLogin();
        Customer::where('customer_id',$customer_id)->update(['customer_status'=>0]);
        Toastr::success('Kích hoạt tài khoản thành công', 'Thành công');
        return Redirect::to('all-customer-ad');
    }
    public function chi_tiet_tai_khoan(Request $request, $customer_id){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_order','asc')->get();
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
        $customer->customer_password = md5($data['customer_password']);
        $customer->save();
        Session::put('message','Cập nhật thông tin thành công');
        return redirect()->back();
    }
}
