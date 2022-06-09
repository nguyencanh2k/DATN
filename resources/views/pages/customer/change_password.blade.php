@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Đổi mật khẩu</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Đổi mật khẩu</li>
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
                                    @if(session()->has('message'))
                                        <div class="alert alert-success">
                                            {!! session()->get('message') !!}
                                            {!! session()->forget('message') !!}
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert alert-danger">
                                            {!! session()->get('error') !!}
                                            {!! session()->forget('error') !!}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @foreach ($change_password_cus as $key => $change_pw)
                                        <form action="{{URL::to('/cap-nhat-mat-khau/'.$change_pw->customer_id)}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="old_password" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="new_password" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Xác nhận mật khẩu mới</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-10">
                                                    <button type="submit" name="update_password" class="btn btn-dark">Cập nhật mật khẩu</button>
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
