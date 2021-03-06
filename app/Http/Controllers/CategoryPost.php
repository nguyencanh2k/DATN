<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\CatePost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
session_start();
class CategoryPost extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.category_post.add_category');
    }
    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category_post = new CatePost();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();
        Toastr::success('Thêm danh mục bài viết thành công', 'Thành công');
        return redirect()->back();
    }
    public function all_category_post(){
        $this->AuthLogin();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        return view('admin.category_post.list_category')->with(compact('category_post'));
    }
    public function unactive_category_post($category_post_id){
        $this->AuthLogin();
        CatePost::where('cate_post_id',$category_post_id)->update(['cate_post_status'=>1]);
        Toastr::success('Không kích hoạt danh mục bài viết thành công', 'Thành công');
        return Redirect::to('all-category-post');
    }
    public function active_category_post($category_post_id){
        $this->AuthLogin();
        CatePost::where('cate_post_id',$category_post_id)->update(['cate_post_status'=>0]);
        Toastr::success('Kích hoạt danh mục bài viết thành công', 'Thành công');
        return Redirect::to('all-category-post');
    }
    public function edit_category_post($category_post_id){
        $this->AuthLogin();

        $category_post = CatePost::find($category_post_id);

        return view('admin.category_post.edit_category')->with(compact('category_post'));
    }
    public function update_category_post(Request $request, $cate_id){
        
        $data = $request->all();
        $category_post = CatePost::find($cate_id);
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();
        Toastr::success('Cập nhật danh mục bài viết thành công', 'Thành công');
        return redirect('/all-category-post');
    }
    public function delete_category_post($cate_id){
        $category_post = CatePost::find($cate_id);
        $category_post->delete();
        Toastr::success('Xóa danh mục bài viết thành công', 'Thành công');
        return redirect()->back();
    }
}
