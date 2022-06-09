@extends('admin_layout')
@section('admin_content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Tổng số sản phẩm</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{$app_product}}</h2>
                        <p class="text-white mb-0">{{$now}}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Tổng số đơn hàng</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{$app_order}}</h2>
                        <p class="text-white mb-0">{{$now}}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Tổng số khách hàng</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{$app_customer}}</h2>
                        <p class="text-white mb-0">{{$now}}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Tổng số bài viết</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{$app_post}}</h2>
                        <p class="text-white mb-0">{{$now}}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thống kê đơn hàng doanh số</h4>
                    <form autocomplete="off" class="w-100">
                        @csrf
                        <div class="row form-material">
                            <div class="col-md-3">
                                <label class="m-t-20">Từ ngày: </label>
                                <input type="text" class="form-control" placeholder="2020-10-15" id="mdate">
                                <input type="button" value="Lọc kết quả" id="btn-dashboard-filter" class="btn btn-primary mt-2">
                            </div>
                            <div class="col-md-3">
                                <label class="m-t-20">Đến ngày: </label>
                                <input type="text" class="form-control" placeholder="2020-11-08" id="mdate2">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                    <label class="m-t-20">Lọc theo: </label>
                                    <select name="" class="dashboard-filter form-control" id="">
                                        <option>---Chọn---</option>
                                        <option value="7ngay">7 ngày qua</option>
                                        <option value="thangtruoc">Tháng trước</option>
                                        <option value="thangnay">Tháng này</option>
                                        <option value="365ngayqua">365 ngày qua</option>
                                    </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Biểu đồ</h4>
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thống kê bài viết, sản phẩm</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Bài viết xem nhiều</h5>
                            <ol class="list-group list-group-numbered">
                                @foreach ($post_views as $key => $post)
                                <li class="list-group-item">
                                    <a class="text-info" style="font-weight:400" target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} | <span class="text-danger">Lượt xem: {{$post->post_views}}</span></a>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <h5>Sản phẩm xem nhiều</h5>
                            <ol class="list-group list-group-numbered">
                                @foreach ($product_views as $key => $pro)
                                <li class="list-group-item">
                                    <a class="text-info" style="font-weight:400" target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}">{{$pro->product_name}} | <span class="text-danger">Lượt xem: {{$pro->product_views}}</span></a>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <h5>Sản phẩm bán chạy</h5>
                            <ol class="list-group list-group-numbered">
                                @foreach ($product_best_seller as $key => $pro_best)
                                <li class="list-group-item">
                                    <a class="text-info" style="font-weight:400" target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro_best->product_id)}}">{{$pro_best->product_name}} | <span class="text-danger">Số lượng bán ra: {{$pro_best->product_sold}}</span></a>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection