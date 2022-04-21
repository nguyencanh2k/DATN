@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">Quên mật khẩu</h1>
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
                                        <h4>Quên mật khẩu</h4>
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div id="lg1" class="tab-pane active">
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
                                                <form action="{{url('/recover-pass')}}" method="post">
                                                    @csrf
                                                    <input type="text" name="email_account" placeholder="Email" />
                                                    <div class="button-box">
                                                        <button type="submit"><span>Gửi</span></button>
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