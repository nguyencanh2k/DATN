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
	
    public function print_order($checkout_code){
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_id',$checkout_code)->get();
		$order = Order::where('order_id',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_id', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						<td>'.$shipping->shipping_notes.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không có';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'</p>
					<p>Thanh toán : '.number_format($total_coupon,0,',','.').'đ'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

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
		if($data['rating']<=1){
			return redirect()->back()->with('error', 'Đánh giá tối thiểu 1 sao');
		}elseif($prd_review){
			Review::where('order_id', $data['order_id'])->where('customer_id', $data['customer_id'])->where('product_id', $data['product_id'])->update(['comment'=>$data['comment'],'rating'=>$data['rating']]); 
			return redirect()->back()->with('message', 'Cập nhật đánh giá thành công');
		}else{
			$review = new Review();
			$review->rating = $data['rating'];
			$review->comment = $data['comment'];
			$review->product_id = $data['product_id'];
			$review->customer_id = $data['customer_id'];
			$review->order_id = $data['order_id'];
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
