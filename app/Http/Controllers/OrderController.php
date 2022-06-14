<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;
use App\CatePost;
use App\Brand;
use App\CategoryProductModel;
use App\Statistic;
use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    public function manage_order(){
    	$order = Order::orderby('created_at','DESC')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_id){
		$order_details = OrderDetails::with('product')->where('order_id',$order_id)->get();
		$order = Order::where('order_id',$order_id)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_id', $order_id)->get();

		foreach($order_details_product as $key => $order_d){
			$product_coupon = $order_d->product_coupon;
		}
        
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));

	}

	public function order_code(Request $request ,$order_id){
		$order = Order::where('order_id',$order_id)->first();
		$order->delete();
        Toastr::success('Xóa đơn hàng thành công', 'Thành công');
        return redirect()->back();

	}

	public function update_order_status(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		//order date
		$order_date = $order->order_date;
		$statistic = Statistic::where('order_date', $order_date)->get();
		if($statistic){
			$statistic_count = $statistic->count();
		}else{
			$statistic_count = 0;
		}
		if($order->order_status==2){
			$total_order = 0;
			$sales = 0;
			$profit = 0;
			$quantity = 0;
			foreach($data['order_product_id'] as $key => $product_id){			
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				$product_price = $product->product_price;
				$product_cost = $product->price_cost;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();
								//update doanh thu
								$quantity+=$qty;
								$total_order+=1;
								$sales+=$product_price*$qty;
								$profit = $sales - ($product_cost*$qty);
						}
				}
			}
			//update doanh so
			if($statistic_count>0){
				$statistic_update = Statistic::where('order_date', $order_date)->first();
				$statistic_update->sales = $statistic_update->sales + $sales;
				$statistic_update->profit = $statistic_update->profit + $profit;
				$statistic_update->quantity = $statistic_update->quantity + $quantity;
				$statistic_update->total_order = $statistic_update->total_order + $total_order;
				$statistic_update->save();
			}else{
				$statistic_new = new Statistic();
				$statistic_new->order_date = $order_date;
				$statistic_new->sales = $sales;
				$statistic_new->profit = $profit;
				$statistic_new->quantity = $quantity;
				$statistic_new->total_order = $total_order;
				$statistic_new->save();
			}
		}
	}

	public function history(Request $request){
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập tài khoản');
		}else{
			//category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
			//seo 
			$meta_desc = "Lịch sử đơn hàng"; 
			$meta_keywords = "Lịch sử đơn hàng";
			$meta_title = "Lịch sử đơn hàng";
			$url_canonical = $request->url();
			//--seo
	
			$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        	$brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
			$getorder = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id', 'DESC')->get();
			return view('pages.history.history')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('getorder',$getorder);
		}
	}
	public function view_history_order(Request $request,$order_id){
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập tài khoản');
		}else{
			//category post
        	$category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
			//seo 
			$meta_desc = "Lịch sử đơn hàng"; 
			$meta_keywords = "Lịch sử đơn hàng";
			$meta_title = "Lịch sử đơn hàng";
			$url_canonical = $request->url();
			//--seo
	
			$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        	$brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
			//lsu don hang
			$order_details = OrderDetails::with('product')->where('order_id',$order_id)->get();
			$getorder = Order::where('order_id',$order_id)->first();
			$customer_id = $getorder->customer_id;
			$shipping_id = $getorder->shipping_id;
			$order_status = $getorder->order_status;
			
			$customer = Customer::where('customer_id',$customer_id)->first();
			$shipping = Shipping::where('shipping_id',$shipping_id)->first();

			$order_details_product = OrderDetails::with('product')->where('order_id', $order_id)->get();

			foreach($order_details_product as $key => $order_d){
				$product_coupon = $order_d->product_coupon;
			}
			
			if($product_coupon != 'no'){
				$coupon = Coupon::where('coupon_code',$product_coupon)->first();
				$coupon_condition = $coupon->coupon_condition;
				$coupon_number = $coupon->coupon_number;
			}else{
				$coupon_condition = 2;
				$coupon_number = 0;
			}
			return view('pages.history.view_history_order')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with(
				'meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with(
				'order_details',$order_details)->with('customer',$customer)->with('shipping',$shipping)->with('order_details',$order_details)->with(
				'coupon_condition',$coupon_condition)->with('coupon_number',$coupon_number)->with('order_status',$order_status)->with('getorder',$getorder);
		}
	}
	public function huy_don_hang(Request $request){
		$data = $request->all();
		$order = Order::where('order_id', $data['order_id'])->first();
		$order->order_destroy = $data['lydo'];
		$order->order_status = 3;
		$order->save();
	}
	public function review_order(Request $request,$order_id){
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập tài khoản');
		}else{
			//category post
        	$category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
			//seo 
			$meta_desc = "Đánh giá sản phẩm"; 
			$meta_keywords = "Đánh giá sản phẩm";
			$meta_title = "Đánh giá sản phẩm";
			$url_canonical = $request->url();
			//--seo
	
			$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        	$brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
			$product_review = OrderDetails::with('product')->where('order_id',$order_id)->get();

			return view('pages.history.review_order')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with(
				'meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('product_review',$product_review)->with('order_id',$order_id);
		}
	}
	public function add_review(Request $request){
		$data = $request->all();
		$prd_review = Review::where('order_id', $data['order_id'])->where('customer_id', $data['customer_id'])->where('product_id', $data['product_id'])->first(); 
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
		if($data['rating']<=1){
			return redirect()->back()->with('error', 'Đánh giá tối thiểu 1 sao');
		}elseif($prd_review){
			Review::where('order_id', $data['order_id'])->where('customer_id', $data['customer_id'])->where('product_id', $data['product_id'])->update(['comment'=>$data['comment'],'rating'=>$data['rating'],'review_date'=>$today]); 
			return redirect()->back()->with('message', 'Cập nhật đánh giá thành công');
		}else{
			$review = new Review();
			$review->rating = $data['rating'];
			$review->comment = $data['comment'];
			$review->product_id = $data['product_id'];
			$review->customer_id = $data['customer_id'];
			$review->order_id = $data['order_id'];
			$review->review_date = $today;
			$review->save();
			return redirect()->back()->with('message', 'Review sản phẩm thành công.');
		}
		
	}
	public function all_review(){
    	$review = Review::with(['customer', 'product'])->orderby('review_id','DESC')->get();
    	return view('admin.reviews.all_review')->with(compact('review'));
	}
    public function unactive_review($review_id){
        Review::where('review_id',$review_id)->update(['review_status'=>1]);
        Toastr::success('Ẩn review thành công', 'Thành công');
        return Redirect::to('all-review');
    }
    public function active_review($review_id){
        Review::where('review_id',$review_id)->update(['review_status'=>0]);
        Toastr::success('Hiển thị review thành công', 'Thành công');
        return Redirect::to('all-review');
    }
}
