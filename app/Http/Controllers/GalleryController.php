<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Gallery;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\CatePost;
use Brian2694\Toastr\Facades\Toastr;
session_start();
class GalleryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_gallery($product_id){
        $this->AuthLogin();
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }
    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form> '.csrf_field().' 
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">Thứ tự</th>
                            <th scope="col">Tên hình ảnh</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

        ';
        if($gallery_count>0){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output.='
                <tr>
                                <td>'.$i.'</td>
                                <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                                <td><img src="'.url('public/uploads/gallery/'.$gal->gallery_image).'"
                                class="img-thumbnail" width="150" height="150">
                                <input type="file" class="file_image" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" 
                                name="file" accept="image/*" />
                                </td>
                                <td><button type="button" class="delete-gallery btn btn-xs btn-danger" data-gal_id="'.$gal->gallery_id.'">Xóa</button></td>
                            </tr>
                            ';
            }
        }else{
            $output.='<tr>
                            <td colspan="4">Sản phẩm chưa có thư viện ảnh</td>
                        </tr>';
        $output.='
                </tbody>
                </table>
                </form>';
        }
        echo $output;
    }
    public function insert_gallery(Request $request, $pro_id){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
               
            }
        }
        //Session::put('message','Thêm thư viện ảnh thành công');
        Toastr::success('Thêm thư viện ảnh thành công', 'Thành công');
        return redirect()->back();
    }
    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/uploads/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/gallery',$new_image);

                $gallery = Gallery::find($gal_id);
                unlink('public/uploads/gallery/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_image;
                $gallery->save();
               
            
        }
    }
}
