<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/favicon.png')}}"> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Đăng nhập</h4></a>
                                <form class="mt-5 mb-5 login-input" action="{{URL::to('/login')}}" method="post">
                                    {{ csrf_field() }}
                                    @if(session()->has('message'))
                                        <div class="alert alert-success">
                                            {!! session()->get('message') !!}
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert alert-danger">
                                            {!! session()->get('error') !!}
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
                                    
                                    <div class="form-group">
                                        <input type="email" name="admin_email" value="{{old('admin_email')}}" class="form-control" placeholder="E-MAIL" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="admin_password" class="form-control" placeholder="PASSWORD" required>
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Đăng nhập</button>
                                </form>
                                <p class="mt-5 login-form__footer">Chưa có tài khoản? <a href="{{URL::to('/register-auth')}}" class="text-primary">Đăng ký</a></p>
                                {{-- <p class="mt-5 login-form__footer"><a href="{{URL::to('/login-auth')}}" class="text-primary">Đăng nhập auth</a></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('public/backend/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('public/backend/js/custom.min.js')}}"></script>
    <script src="{{asset('public/backend/js/settings.js')}}"></script>
    <script src="{{asset('public/backend/js/gleek.js')}}"></script>
    <script src="{{asset('public/backend/js/styleSwitcher.js')}}"></script>
</body>
</html>





