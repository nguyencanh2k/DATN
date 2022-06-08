@extends('admin_layout')
@section('admin_content')
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
                            <td><div class="rateYo_show" data-rating="{{$rev['rating']}}"></div></td>
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
@endsection