<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class CouponController extends Controller
{
    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã giảm giá thành công');
        }
	}
    public function insert_coupon(){
    	return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
		Toastr::success('Xóa mã giảm giá thành công', 'Thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.coupon.list_coupon')->with(compact('coupon', 'today'));
    }
    public function insert_coupon_code(Request $request){
    	$data = $request->all();

    	$coupon = new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_date_start = $data['coupon_date_start'];
    	$coupon->coupon_date_end = $data['coupon_date_end'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();

		Toastr::success('Thêm mã giảm giá thành công', 'Thành công');
        return Redirect::to('insert-coupon');


    }
}
