@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê mã giảm giá</h4>
                    
                    <div class="table-responsive"> 
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <table class="table table-bordered table-striped verticle-middle" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên mã giảm giá</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Mã giảm giá</th>
                                    <th scope="col">Số lượng mã giảm giá</th>
                                    <th scope="col">Điều kiện giảm giá</th>
                                    <th scope="col">Số giảm</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Hạn sử dụng</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($coupon as $key => $cou)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $cou->coupon_name }}</td>
                                    <td>{{ $cou->coupon_date_start }}</td>
                                    <td>{{ $cou->coupon_date_end }}</td>
                                    <td>{{ $cou->coupon_code }}</td>
                                    <td>{{ $cou->coupon_time }}</td>
                                    <td>
                                        <?php
                                        if($cou->coupon_condition==1){
                                            ?>
                                            Giảm theo %
                                            <?php
                                            }else{
                                            ?>  
                                            Giảm theo tiền
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($cou->coupon_condition==1){
                                            ?>
                                            Giảm {{$cou->coupon_number}} %
                                            <?php
                                            }else{
                                            ?>  
                                            Giảm {{$cou->coupon_number}} k
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($cou->coupon_status==1){
                                            ?>
                                            <span style="color: green">Đang kích hoạt</span>
                                            <?php
                                            }else{
                                            ?>  
                                            <span style="color: red">Đã khóa</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        @if($cou->coupon_date_end>=$today)
                                            <span style="color: green">Còn hạn</span>
                                        @else
                                            <span style="color: red">Hết hạn</span>
                                        @endif
                                    </td>
                                    <td><span>
                                        <a href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
                                    </span></td>
                                    <td><span>
                                        <a class="btn btn-sm btn-success" href="{{URL::to('/send-coupon/'.$cou->coupon_id)}}" data-toggle="tooltip" data-placement="top" title="Send">Gửi</a>
                                    </span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection