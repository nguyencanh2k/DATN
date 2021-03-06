@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">
                <?php
                    $admin_id= Auth::user()->admin_id;
                ?>
                <a href="{{URL::to('/profile-admin/'.$admin_id)}}">Thông tin tài khoản</a>
            </li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-4"></div>
        <div class="col-lg-4 col-xl-4">
            <div class="card">
                @foreach ($profile as $key => $prof)
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="{{asset('public/backend/images/user/avatar_admin.png')}}" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0">{{$prof->admin_name}}</h3>
                        </div>
                    </div>
    
                    <h4>Thông tin tài khoản</h4>
                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{$prof->admin_phone}}</span></li>
                        <li><strong class="text-dark mr-4">Email</strong> <span>{{$prof->admin_email}}</span></li>
                    </ul>
                </div>
                @endforeach
            </div>  
        </div>
        <div class="col-lg-4 col-xl-4"></div>
    </div>
</div>
@endsection