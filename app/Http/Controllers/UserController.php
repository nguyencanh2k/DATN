<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Roles;
use App\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(10);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('admin.users.add_users');
    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            Toastr::error('Bạn không được phân quyền cho chính mình', 'Thất bại');
            return redirect()->back();
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['editer_role']){
           $user->roles()->attach(Roles::where('name','editer')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        Toastr::success('Cấp quyền user thành công', 'Thành công');
        return redirect()->back();
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $user_ad = Admin::where('admin_email', $data['admin_email'])->first();
        if ($user_ad) {
            Toastr::error('Email đã tồn tại.', 'Thất bại');
            return redirect()->back();
        } else {
            $admin->save();
            $admin->roles()->attach(Roles::where('name','user')->first());
            Toastr::success('Thêm users thành công', 'Thành công');
            return Redirect::to('users');
        }
    }
    public function edit_user_roles($admin_id){
        $edit_users = Admin::where('admin_id',$admin_id)->get();

        return view('admin.users.edit_users')->with('edit_users', $edit_users);
    }
    public function update_user_roles(Request $request, $admin_id){
        $data = $request->all();
        $admin = Admin::find($admin_id);
        
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        Toastr::success('Cập nhật thông tin nhân viên thành công', 'Thành công');
        return Redirect::to('users');
    }
    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            Toastr::error('Bạn không được xóa chính mình', 'Thất bại');
            return redirect()->back();
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        Toastr::success('Xóa user thành công', 'Thành công');
        return redirect()->back();
    }
    public function profile_admin($admin_id){
        $profile = Admin::where('admin_id',$admin_id)->get();

        return view('admin.users.profile_users')->with('profile', $profile);
    }
}
