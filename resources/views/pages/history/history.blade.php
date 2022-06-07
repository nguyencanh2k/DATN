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
                            <td>{{$ord->order_id}}</td>
                            <td>{{ $ord->created_at }}</td>
                            <td>@if($ord->order_status==1)
                                <span class="text text-success">Đơn hàng mới</span> 
                            @elseif($ord->order_status==2)
                                <span class="text text-primary">Đã xử lý - Đã giao hàng</span> 
                            @else
                                <span class="text text-danger">Đơn hàng đã bị hủy</span> 
                            @endif
                            </td>
                            <td>
                                @if($ord->order_status==1)
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon_{{$ord->order_id}}">
                                    Hủy đơn hàng
                                </button>
                                @endif
                                <form>
                                    @csrf
                                    <div class="modal fade" id="huydon_{{$ord->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Lý do hủy đơn hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea id="lydohuydon_{{$ord->order_id}}" cols="110" rows="10"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="button" id="{{$ord->order_id}}" onclick="Huydonhang(this.id)" class="btn btn-success">Gửi</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                                <span>
                                <a href="{{URL::to('/view-history-order/'.$ord->order_id)}}" data-toggle="tooltip" data-placement="top" title="View">Xem đơn hàng</a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection