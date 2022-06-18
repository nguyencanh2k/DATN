@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-customer-ad')}}">Liệt kê khách hàng</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê khách hàng</h4>
                    
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
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Tình trạng tài khoản</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($all_customer_ad as $key => $cus)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $cus->customer_name }}</td>
                                    <td>{{ $cus->customer_email }}</td>
                                    <td>{{ $cus->customer_phone }}</td>
                                    <td>{{ $cus->customer_password }}</td>
                                    <td>
                                        <?php
                                            if($cus->customer_status==0){
                                        ?>
                                            <a href="{{URL::to('/unactive-customer/'.$cus->customer_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hoạt động</b></span></a>
                                        <?php
                                            }else{
                                        ?>  
                                            <a href="{{URL::to('/active-customer/'.$cus->customer_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Khóa</b></span></a>
                                        <?php
                                            }
                                        ?>
                                    </td>
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