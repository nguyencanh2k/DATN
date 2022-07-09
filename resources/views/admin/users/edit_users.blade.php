@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/users')}}">Sửa thông tin nhân viên</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa thông tin nhân viên</h4>
                    
                    <div class="basic-form">
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        @foreach ($edit_users as $key => $edit_ad)
                            
                        <form action="{{URL::to('/update-user-roles/'.$edit_ad->admin_id)}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" name="admin_name" value="{{$edit_ad->admin_name}}" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="admin_email" value="{{$edit_ad->admin_email}}" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" name="admin_phone" value="{{$edit_ad->admin_phone}}" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="text" name="admin_password" value="" class="form-control" placeholder="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" name="update_admin" class="btn btn-dark">Cập nhật thông tin nhân viên</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection