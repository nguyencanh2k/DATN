<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProductModel;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\CatePost;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.category_product.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = CategoryProductModel::orderBy('category_order', 'ASC')->get();
        $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.category_product.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Toastr::success('Thêm danh mục sản phẩm thành công', 'Thành công');
        return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>1]);
        Toastr::success('Không kích hoạt danh mục sản phẩm thành công', 'Thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>0]);
        Toastr::success('Kích hoạt danh mục sản phẩm thành công', 'Thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = CategoryProductModel::where('category_id',$category_product_id)->get();

        $manager_category_product  = view('admin.category_product.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.category_product.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        //Session::put('message','Cập nhật danh mục sản phẩm thành công');
        Toastr::success('Cập nhật danh mục sản phẩm thành công', 'Thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->delete();
        Toastr::success('Xóa danh mục sản phẩm thành công', 'Thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home(Request $request , $category_id){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id', $category_id)->get();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $min_price_range = $min_price + 1000000;
        $max_price_range = $max_price + 5000000;
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_price','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_price','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name','ASC')->paginate(10)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $category_by_id = Product::with('category')->whereBetween('product_price', [$min_price, $max_price])->orderBy('product_id', 'ASC')->paginate(10)->appends(request()->query());
        }elseif(isset($_GET['cate'])){
            $category_filter = $_GET['cate'];
            $category_arr = explode(",", $category_filter);
            $category_by_id = Product::with('category')->whereIn('category_id', $category_arr)->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());
        }else{
            $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_id','DESC')->paginate(20);
        }
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        foreach($category_name as $key => $val){
            //seo 
            $meta_desc = $val->category_desc; 
            $meta_keywords = 'Danh mục sản phẩm';
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
            //--seo
            }
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('min_price_range',$min_price_range)->with('max_price_range',$max_price_range);
    }
    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $product = Product::where('category_id',$data['cate_id'])->orderBy('product_id','DESC')->get();
        $product_count = $product->count();
        if($product_count>0){
            $output.='<div class="new-product-slider owl-carousel owl-nav-style" >';
            foreach($product as $key => $val){
                $output.='
                <div class="product-inner-item">
                                <article class="list-product mb-30px">
                                <input type="hidden" value="'.$val->product_id.'" class="cart_product_id_'.$val->product_id.'">
                                <input type="hidden" value="'.$val->product_name.'" class="cart_product_name_'.$val->product_id.'">
                                <input type="hidden" value="'.$val->product_image.'" class="cart_product_image_'.$val->product_id.'">
                                <input type="hidden" value="'.$val->product_price.'" class="cart_product_price_'.$val->product_id.'">
                                <input type="hidden" value="'.$val->product_quantity.'" class="cart_product_quantity_'.$val->product_id.'">
                                <input type="hidden" value="1" class="cart_product_qty_'.$val->product_id.'">
                                    <div class="img-block">
                                        <a href="'.url('/chi-tiet-san-pham/'.$val->product_id).'" class="thumbnail">
                                            <img class="first-img" src="'.url('public/uploads/product/'.$val->product_image).'" alt="'.$val->product_name.'" />
                                        </a>
                                        <div class="quick-view">
                                            <a class="quick_view xemnhanh" href="#" data-link-action="quickview" title="Quick view" onclick="Xemnhanh(this.id);" id="'.$val->product_id.'" data-toggle="modal" data-target="#exampleModal">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-decs">
                                        <a class="inner-link prd-name-hidden" href="'.url('/chi-tiet-san-pham/'.$val->product_id).'"><span>'.$val->product_name.'</span></a>
                                        
                                        <div class="pricing-meta">
                                            <ul>
                                                <li class="current-price">'.number_format($val->product_price,0,',','.').'VND</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li class="cart"><a class="cart-btn add-to-cart" onclick="Addtocart(this.id);" id="'.$val->product_id.'" name="add-to-cart">Thêm vào giỏ hàng </a></li>
                                            <li>
                                                <a href=""><i class="ion-android-favorite-outline"></i></a>
                                            </li>
                                            <li>
                                                <a href=""><i class="ion-ios-shuffle-strong"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                </div>
                        ';}
            $output.='</div>';
        }
        echo $output;
    }
    public function arrange_category(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = CategoryProductModel::find($value);
            $category->category_order = $key; //key: 0 1 2, value: category_id
            $category->save();
        }
        echo 'Updated';
    }
}
