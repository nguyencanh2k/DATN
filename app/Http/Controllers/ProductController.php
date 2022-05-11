<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\CatePost;
use App\Gallery;
use App\Product;
use App\Comment;
use App\Rating;
use File;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 
       
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product  = view('admin.product.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.product.all_product', $manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
    	$data['product_name'] = $request->product_name;
    	$data['price_cost'] = $price_cost;
    	$data['product_tags'] = $request->product_tags;
    	$data['product_quantity'] = $request->product_quantity;
    	$data['product_sold'] = '0';
    	$data['product_price'] = $product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }
        // $data['product_image'] = '';
    	// DB::table('tbl_product')->insert($data);
    	// Session::put('message','Thêm sản phẩm thành công');
    	// return Redirect::to('all-product');
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_name = $new_image;
        $gallery->gallery_image = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        //Session::put('message','Thêm sản phẩm thành công');
        Toastr::success('Thêm sản phẩm thành công', 'Thành công');
        return Redirect::to('add-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        //Session::put('message','Không kích hoạt sản phẩm thành công');
        Toastr::success('Không kích hoạt sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        //Session::put('message','Kích hoạt sản phẩm thành công');
        Toastr::success('Kích hoạt sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product  = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
        $data['product_name'] = $request->product_name;
    	$data['price_cost'] = $price_cost;
    	$data['product_tags'] = $request->product_tags;
    	$data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Toastr::success('Cập nhật sản phẩm thành công', 'Thành công');
                    //Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        //Session::put('message','Cập nhật sản phẩm thành công');
        Toastr::success('Cập nhật sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        //Session::put('message','Xóa sản phẩm thành công');
        Toastr::success('Xóa sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_id, Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();


        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            //seo 
            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_name;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
            //--seo
        }
        //gallery
        $gallery = Gallery::where('product_id', $product_id)->take(4)->get();
        //update view
        $product = Product::where('product_id', $product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('gallery',$gallery)->with('rating',$rating);
    }
    public function tat_ca_san_pham(Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        // $show_all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(10)->get();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $min_price_range = $min_price + 1000000;
        $max_price_range = $max_price + 5000000;
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $show_all_product = Product::orderBy('product_price','DESC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $show_all_product = Product::orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $show_all_product = Product::orderBy('product_name','DESC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $show_all_product = Product::orderBy('product_name','ASC')->paginate(12)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $show_all_product = Product::whereBetween('product_price', [$min_price, $max_price])->paginate(12)->appends(request()->query());
        }else{
            $show_all_product = Product::where('product_status','0')->paginate(12);
        }
        //seo 
            $meta_desc = 'Tất cả sản phẩm';
            $meta_keywords = 'Tất cả sản phẩm';
            $meta_title = 'Tất cả sản phẩm';
            $url_canonical = $request->url();
        //--seo
        
        return view('pages.sanpham.show_all_product')->with('category',$cate_product)->with('brand',$brand_product)->with('show_all_product',$show_all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with(
            'min_price',$min_price)->with('max_price',$max_price)->with('min_price_range',$min_price_range)->with('max_price_range',$max_price_range);
    }
    public function tag($product_tag, Request $request){
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $tag = str_replace("-"," ",$product_tag);
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan'){
                $pro_tag = Product::where('product_status', 0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $pro_tag = Product::where('product_status', 0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $pro_tag = Product::where('product_status', 0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orderBy('product_name','DESC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $pro_tag = Product::where('product_status', 0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orderBy('product_name','ASC')->paginate(12)->appends(request()->query());
            }
        }else{
            $pro_tag = Product::where('product_status', 0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->paginate(12);
        }

        //seo 
        $meta_desc = 'Tags:'.$product_tag;
        $meta_keywords = 'Tags:'.$product_tag;
        $meta_title = 'Tags:'.$product_tag;
        $url_canonical = $request->url();
        //--seo
        
        
        return view('pages.sanpham.tag')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }
    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id', $product_id)->get();
        $output['product_gallery']='';
        foreach($gallery as $key =>$gal){
            $output['product_gallery'].='<img src="public/uploads/gallery/'.$gal->gallery_image.'"/>';

        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').'VND';
        $output['product_image'] = '<img src="public/uploads/product/'.$product->product_image.'"/>';
        $output['product_button'] ='<a type="button" id="buyquickview"  data-id_product="'.$product->product_id.'" class="add-to-cart-quickview" name="add-to-cart" />Thêm vào giỏ hàng';
        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';
        echo json_encode($output);
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();

    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', '=', 0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= '            
                <div class="single-review">
                    <div class="review-img">
                        <img width="100" height="100" src="'.url('/public/frontend/images/guest.jpg').'" alt="" />
                    </div>
                    <div class="review-content">
                        <div class="review-top-wrap">
                            <div class="review-left">
                                <div class="review-name">
                                    <h4>'.$comm->comment_name.'</h4>
                                </div>
                            </div>
                        </div>
                        <div class="review-bottom">
                            <p>'.$comm->comment.'</p>
                        </div>
                    </div>
                </div>';
            foreach($comment_rep as $key => $rep_comment){
                if($rep_comment->comment_parent_comment==$comm->comment_id){
            $output.= '
            <div class="single-review child-review">
                    <div class="review-img">
                        <img width="60" height="60" src="'.url('/public/frontend/images/avatar_admin.png').'" alt="" />
                    </div>
                    <div class="review-content">
                        <div class="review-top-wrap">
                            <div class="review-left">
                                <div class="review-name">
                                    <h4>@Admin</h4>
                                </div>
                            </div>
                        </div>
                        <div class="review-bottom">
                            <p>'.$rep_comment->comment.'</p>
                        </div>
                    </div>
                </div>';}}
        
        }
        echo $output;
    }
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)->orderBy('comment_id', 'DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_rep'));
    }
    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status  = $data['comment_status'];
        $comment->save();

    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment  = $data['comment_id'];
        $comment->comment_status  = 0;
        $comment->comment_name  = 'Admin';
        $comment->save();

    }
    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';


    }
}
