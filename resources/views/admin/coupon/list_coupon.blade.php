@extends('admin_layout')
@section('admin_content')
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
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên mã giảm giá</th>
                            <th scope="col">Mã giảm giá</th>
                            <th scope="col">Số lượng mã giảm giá</th>
                            <th scope="col">Điều kiện giảm giá</th>
                            <th scope="col">Số giảm</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $key => $cou)
                        <tr>
                            <td>{{ $cou->coupon_id }}</td>
                            <td>{{ $cou->coupon_name }}</td>
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
                            <td><span>
                                <a href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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