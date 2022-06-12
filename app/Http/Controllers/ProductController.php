<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\CatePost;
use App\Gallery;
use App\Product;
use App\Review;
use App\Comment;
use App\Customer;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $cate_product = CategoryProductModel::orderby('category_id','desc')->get(); 
        $brand_product = Brand::orderby('brand_id','desc')->get(); 
       
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = Product::with(['category','brand'])->orderby('tbl_product.product_id','desc')->get();
    	$manager_product  = view('admin.product.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.product.all_product', $manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $product = new Product();
        $product_price = filter_var($data['product_price'], FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($data['price_cost'], FILTER_SANITIZE_NUMBER_INT);
        $product->product_name = $data['product_name'];
        $product->price_cost = $price_cost;
        $product->product_tags = $data['product_tags'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_sold = '0';
        $product->product_price = $product_price;
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_status = $data['product_status'];
        $product->product_image = $data['product_image'];
        $get_image = request('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $product->product_image = $new_image;
            
        }
        $product->save();
        $gallery = new Gallery();
        $gallery->gallery_name = $new_image;
        $gallery->gallery_image = $new_image;
        $gallery->product_id = $product->product_id;
        $gallery->save();
        Toastr::success('Thêm sản phẩm thành công', 'Thành công');
        return Redirect::to('add-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->update(['product_status'=>1]);
        Toastr::success('Không kích hoạt sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->update(['product_status'=>0]);
        Toastr::success('Kích hoạt sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = CategoryProductModel::orderby('category_id','desc')->get(); 
        $brand_product = Brand::orderby('brand_id','desc')->get(); 
        $edit_product = Product::where('product_id',$product_id)->get();

        $manager_product  = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = $request->all();
        $product = Product::find($product_id);
        $product_price = filter_var($data['product_price'], FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($data['price_cost'], FILTER_SANITIZE_NUMBER_INT);
        $product->product_name = $data['product_name'];
        $product->price_cost = $price_cost;
        $product->product_tags = $data['product_tags'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_price = $product_price;
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_status = $data['product_status'];
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $product->product_image = $new_image;
                    $product->save();
                    Toastr::success('Cập nhật sản phẩm thành công', 'Thành công');
                    return Redirect::to('all-product');
        }
            
        $product->save();
        Toastr::success('Cập nhật sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product->delete();
        Toastr::success('Xóa sản phẩm thành công', 'Thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_id, Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get(); 
        $details_product = Product::with(['category','brand'])->where('product_id',$product_id)->get();


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
        $related_product = Product::with(['category','brand'])->where('category_id',$category_id)->whereNotIn('product_id',[$product_id])->get();
        $review = Review::with(['customer', 'product'])->where('product_id', $product_id)->where('review_status', '0')->get()->toArray();
        $review_avg = Review::where('product_id', $product_id)->avg('rating');
        $review_count = Review::where('product_id', $product_id)->count('comment'); 
        $comment = Comment::where('product_id', $product_id)->where('comment_parent', '=', 0)->get();
        $comment_reply = Comment::with('product')->where('comment_parent', '>', 0)->get(); 
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with(
            'product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with(
            'meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with(
            'category_post',$category_post)->with('gallery',$gallery)->with('review',$review)->with('review_avg',$review_avg)->with(
            'review_count',$review_count)->with('comment',$comment)->with('comment_reply',$comment_reply);
    }
    public function tat_ca_san_pham(Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get(); 
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
        }elseif(isset($_GET['filterbrand'])){
            $brand_filter = $_GET['filterbrand'];
            $show_all_product = Product::with('brand')->whereIn('brand_id', $brand_filter)->paginate(12)->appends(request()->query());
        }elseif(isset($_GET['filtercategory'])){
            $category_filter = $_GET['filtercategory'];
            $show_all_product = Product::with('category')->whereIn('category_id', $category_filter)->paginate(12)->appends(request()->query());
        }else{
            $show_all_product = Product::where('product_status','0')->paginate(12);
        }
        //seo 
            $meta_desc = 'Tất cả sản phẩm';
            $meta_keywords = 'Tất cả sản phẩm';
            $meta_title = 'Tất cả sản phẩm';
            $url_canonical = $request->url();
        //--seo
        $count_prd = count($show_all_product);
        
        return view('pages.sanpham.show_all_product')->with('category',$cate_product)->with('brand',$brand_product)->with('show_all_product',$show_all_product)->with(
            'meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with(
            'min_price',$min_price)->with('max_price',$max_price)->with('min_price_range',$min_price_range)->with('max_price_range',$max_price_range)->with('count_prd',$count_prd);
    }
    public function tag($product_tag, Request $request){
        //category post
        $category_post = CatePost::where('cate_post_status','0')->orderBy('cate_post_id', 'DESC')->get();
        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_order','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_order','asc')->get(); 
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
        $count_prd = count($pro_tag);
        
        return view('pages.sanpham.tag')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with(
        'meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with(
        'category_post',$category_post)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag)->with('count_prd',$count_prd);
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
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';
        echo json_encode($output);
    }
    public function add_comment(Request $request){
        $data = $request->all();
        if($data['comment_name'] == 'ADMIN'){
            return redirect()->back()->with('message', 'Bạn không được đặt tên này');
        }else{
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $comment = new Comment();
            $comment->comment_name = $data['comment_name'];
            $comment->product_id = $data['product_id'];
            $comment->comment = $data['comment'];
            $comment->comment_parent = 0;
            $comment->created_at = $today;
            $comment->save();
            return redirect()->back()->with('message', 'Bình luận sản phẩm thành công.');
        }
    }
    public function all_comment(){
        $comment = Comment::with('product')->where('comment_parent', '=', 0)->orderBy('comment_id', 'DESC')->get();
        $comment_reply = Comment::with('product')->where('comment_parent', '>', 0)->get();
        return view('admin.comment.all_comment')->with(compact('comment', 'comment_reply'));
    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $comment = new Comment();
        $comment->comment_name = 'ADMIN';
        $comment->product_id = $data['product_id'];
        $comment->comment = $data['reply_comment'];
        $comment->comment_parent = $data['comment_id'];
        $comment->created_at = $today;
        $comment->save();
        Toastr::success('Trả lời bình luận thành công', 'Thành công');
        return redirect()->back();
    }
    public function delete_comment($comment_id){
        $comment = Comment::where('comment_id', $comment_id)->delete();
        $comment_parent = Comment::where('comment_parent', $comment_id)->delete();
        Toastr::success('Xóa bình luận thành công', 'Thành công');
        return redirect()->back();
    }
    public function reply_comment_guest(Request $request){
        $data = $request->all();
        if($data['comment_name'] == 'ADMIN'){
            return redirect()->back()->with('message', 'Bạn không được đặt tên này');
        }else{
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $comment = new Comment();
            $comment->comment_name = $data['comment_name'];
            $comment->product_id = $data['product_id'];
            $comment->comment = $data['reply_comment'];
            $comment->comment_parent = $data['comment_id'];
            $comment->created_at = $today;
            $comment->save();
            return redirect()->back();
        }
    }
}
