@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liệt kê đơn hàng</h4>
            
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
                            <th scope="col">ID</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Thời gian đặt hàng</th>
                            <th scope="col">Tình trạng đơn hàng</th>
                            <th scope="col">Lý do hủy đơn</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($order as $key => $ord)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$ord->order_code}}</td>
                            <td>{{ $ord->created_at }}</td>
                            <td>@if($ord->order_status==1)
                                <span class="text text-success">Đơn hàng mới</span> 
                            @elseif($ord->order_status==2)
                                <span class="text text-primary">Đã xử lý - Đã giao hàng</span> 
                            @else
                                <span class="text text-danger">Đơn hàng đã bị hủy</span> 
                            @endif
                            </td>
                            <td>@if($ord->order_status==3)
                                {{$ord->order_destroy}}
                                @endif
                            </td>
                            <td><span>
                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye text-success m-r-5 text-active"></i></a>
                                <a href="{{URL::to('/delete-order/'.$ord->order_code)}}" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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