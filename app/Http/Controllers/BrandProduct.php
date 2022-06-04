<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\CatePost;
use App\Product;
use App\Brand;
use App\CategoryProductModel;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.brand.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        // $all_brand_product = DB::table('tbl_brand')->get();
        // $all_brand_product = Brand::all(); 
        $all_brand_product = Brand::orderBy('brand_order','ASC')->get();
        $manager_brand_product = view('admin.brand.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.brand.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        //model
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        //db
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;

        // DB::table('tbl_brand')->insert($data);
        Toastr::success('Thêm thương hiệu sản phẩm thành công', 'Thành công');
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        Brand::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Toastr::success('Không kích hoạt thương hiệu sản phẩm thành công', 'Thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        Brand::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Toastr::success('Kích hoạt thương hiệu sản phẩm thành công', 'Thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        $manager_brand_product  = view('admin.brand.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.brand.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        // $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Toastr::success('Cập nhật thương hiệu sản phẩm thành công', 'Thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        Brand::where('brand_id',$brand_product_id)->delete();
        Toastr::success('Xóa thương hiệu sản phẩm thành công', 'Thành công');
        return Redirect::to('all-brand-product');
    }
    //End Function Admin Page
    public function show_brand_home(Request $request, $brand_id){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get();
        // $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_id)->get();
        $brand_name = Brand::where('tbl_brand.brand_id',$brand_id)->first();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $min_price_range = $min_price + 1000000;
        $max_price_range = $max_price + 5000000;
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name','ASC')->paginate(10)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $brand_by_id = Product::with('brand')->whereBetween('product_price', [$min_price, $max_price])->orderBy('product_id', 'ASC')->paginate(10)->appends(request()->query());
        }elseif(isset($_GET['brand'])){
            //$brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_id)->get();
            $brand_id = $_GET['brand'];
            $brand_arr = explode(",", $brand_id);
            $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->whereIn('tbl_product.brand_id', $brand_arr)->paginate(2)->appends(request()->query());
        }else{
            $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_name->brand_id)->paginate(2);
        }
        //seo 
        $meta_desc = $brand_name->brand_desc; 
        $meta_keywords = $brand_name->brand_desc;
        $meta_title = $brand_name->brand_name;
        $url_canonical = $request->url();
        //--seo

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with(
            'brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with(
            'url_canonical',$url_canonical)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('min_price_range',$min_price_range)->with('max_price_range',$max_price_range);
    }
    public function arrange_brand(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand_id = $data["page_id_array"];
        foreach($brand_id as $key => $value){
            $brand = Brand::find($value);
            $brand->brand_order = $key; //key: 0 1 2, value: brand_id
            $brand->save();
        }
        echo 'Updated';
    }
}
