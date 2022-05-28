<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Roles;
use App\Admin;
use Session;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
class UserController extends Controller
{
    public function index()
    {
        
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->get();
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('admin.users.add_users');
    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            return redirect()->back()->with('message', 'Bạn không được phân quyền cho chính mình');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message', 'Cấp quyền user thành công');
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
            return redirect()->back()->with('message', 'Email đã tồn tại.');
        } else {
            $admin->save();
            $admin->roles()->attach(Roles::where('name','user')->first());
            Session::put('message','Thêm users thành công');
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
            return redirect()->back()->with('message', 'Bạn không được xóa chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message', 'Xóa user thành công');
    }
    public function impersonate($admin_id){
        $user = Admin::where('admin_id', $admin_id)->first();
        if($user){
            session()->put('impersonate', $user->admin_id);
        }
        return redirect('/users');
    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/users');
    }
}
