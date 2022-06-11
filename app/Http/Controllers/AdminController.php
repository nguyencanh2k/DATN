<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Login;
use Illuminate\Support\Facades\Redirect;
use App\Statistic;
use App\Product;
use App\Post;
use App\Customer;
use App\Order;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin.custom_auth.login_auth');
    }
    public function show_dashboard(Request $request){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total
        $app_product = Product::all()->count();
        $product_views = Product::orderBy('product_views', 'DESC')->take(5)->get();
        $product_best_seller = Product::orderBy('product_sold', 'DESC')->take(5)->get();
        $app_post = Post::all()->count();
        $post_views = Post::orderBy('post_views', 'DESC')->take(5)->get();
        $app_order = Order::all()->count();
        $app_customer = Customer::all()->count();
        return view('admin.dashboard')->with(compact('app_product', 'app_post', 'app_order', 'app_customer', 'now', 'product_views', 'post_views', 'product_best_seller'));
    }
    public function dashboard(Request $request){
        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required',
            'admin_password' => 'required',   
        ]);

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date', 'ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date', 'ASC')->get();
        }
        foreach($get as $key =>$val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(Request $request){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date', 'ASC')->get();
        
        foreach($get as $key =>$val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
