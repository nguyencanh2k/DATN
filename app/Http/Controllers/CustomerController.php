<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Customer;
use Session;
use Auth;
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
        $all_customer_ad = Customer::orderBy('customer_id','DESC')->paginate(5);
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
        $customer->save();
        Session::put('message','Thêm khách hàng thành công');
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
        Session::put('message','Cập nhật thông tin khách hàng thành công');
        return Redirect::to('all-customer-ad');
    }
    public function delete_customer_ad($customer_id){
        $delete_cus = Customer::find($customer_id);
        $delete_cus->delete();
        Session::put('message','Xóa khách hàng thành công');
        return redirect()->back();
    }
}
