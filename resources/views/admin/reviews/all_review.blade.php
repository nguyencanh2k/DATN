@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-review')}}">Liệt kê đánh giá</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê đánh giá</h4>
                    
                    <div class="table-responsive"> 
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <table class="table table-bordered table-striped verticle-middle"  id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Bình luận</th>
                                    <th scope="col">Đánh giá</th>
                                    <th scope="col">Ngày đánh giá</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Hiển thị</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($review as $key => $rev)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$rev->customer->customer_name}}</td>
                                    <td>{{$rev->comment}}</td>
                                    <td>{{$rev['rating']}}/5 sao</td>
                                    <td>{{$rev->review_date}}</td>
                                    <td><a target="_blank" href="{{url('/chi-tiet-san-pham/'.$rev->product->product_id)}}">{{$rev->product->product_name}}</a></td>
                                    <td>
                                        <?php
                                            if($rev->review_status==0){
                                        ?>
                                            <a href="{{URL::to('/unactive-review/'.$rev->review_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                        <?php
                                            }else{
                                        ?>  
                                            <a href="{{URL::to('/active-review/'.$rev->review_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="" method="post">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection