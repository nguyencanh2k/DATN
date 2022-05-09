@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Đăng nhập/ Đăng ký</h1>
                                <ul class="breadcrumb-links">
                                    <li><a href="index.html">Trang chủ</a></li>
                                    <li>Đăng nhập / Đăng ký</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Breadcrumb Area End -->
            <!-- login area start -->
            <div class="login-register-area mb-60px mt-53px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                            <div class="login-register-wrapper">
                                <div class="login-register-tab-list nav">
                                    <a class="active" data-toggle="tab" href="#lg1">
                                        <h4>Đăng nhập</h4>
                                    </a>
                                    <a data-toggle="tab" href="#lg2">
                                        <h4>Đăng ký</h4>
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div id="lg1" class="tab-pane active">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                @if(session()->has('message'))
                                                    <div class="alert alert-success">
                                                        {!! session()->get('message') !!}
                                                    </div>
                                                @elseif(session()->has('error'))
                                                    <div class="alert alert-danger">
                                                        {!! session()->get('error') !!}
                                                    </div>
                                                @endif
                                                <form action="{{URL::to('/login-customer')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="text" name="email_account" placeholder="Username" />
                                                    <input type="password" name="password_account" placeholder="Password" />
                                                    <div class="button-box">
                                                        <div class="login-toggle-btn">
                                                            <input type="checkbox" />
                                                            <a class="flote-none" href="javascript:void(0)">Remember me</a>
                                                            <a href="{{url('/quen-mat-khau')}}">Quên mật khẩu?</a>
                                                        </div>
                                                        <button type="submit"><span>Đăng nhập</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lg2" class="tab-pane">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                @if(session()->has('message'))
                                                    <div class="alert alert-success ml-3">
                                                        {!! session()->get('message') !!}
                                                    </div>
                                                @elseif(session()->has('error'))
                                                    <div class="alert alert-danger ml-3">
                                                        {!! session()->get('error') !!}
                                                    </div>
                                                @endif
                                                <form action="{{URL::to('/add-customer')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="text" name="customer_name" placeholder="Họ và tên"/>
                                                    <input name="customer_email" placeholder="Email" type="email"/>
                                                    <input type="password" name="customer_password" placeholder="Mật khẩu"/>
                                                    <input type="text" name="customer_phone" placeholder="Số điện thoại"/>
                                                    <div class="button-box">
                                                        <button type="submit"><span>Đăng ký</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login area end -->
@endsection