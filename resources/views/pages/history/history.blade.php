@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">{{$meta_title}}</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Lịch sử đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Đơn hàng đã đặt</h4>
            
            <div class="table-responsive"> 
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Thời gian đặt hàng</th>
                            <th scope="col">Tình trạng đơn hàng</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($getorder as $key => $ord)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$ord->order_code}}</td>
                            <td>{{ $ord->created_at }}</td>
                            <td>@if($ord->order_status==1)
                                Đơn hàng mới
                            @else 
                                Đã xử lý
                            @endif
                            </td>
                            <td><span>
                                <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" data-toggle="tooltip" data-placement="top" title="View">Xem đơn hàng</a>
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection