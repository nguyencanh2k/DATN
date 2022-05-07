@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Chi tiết tài khoản</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Chi tiết tài khoản</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<div class="login-register-area mb-60px mt-53px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php
                                        $message= Session::get('message');
                                        if($message){
                                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                                                Session::put('message', null);
                                        }
                                    ?>
                                    @foreach ($profile_customer as $key => $edit_cus)
                                        <form action="{{URL::to('/cap-nhat-tai-khoan/'.$edit_cus->customer_id)}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="customer_name" value="{{$edit_cus->customer_name}}" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="customer_email" value="{{$edit_cus->customer_email}}" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="customer_phone" value="{{$edit_cus->customer_phone}}" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Mật khẩu</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="customer_password" value="{{$edit_cus->customer_password}}" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" name="update_customer" class="btn btn-dark">Cập nhật thông tin tài khoản</button>
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
        </div>
    </div>
</div>
@endsection
