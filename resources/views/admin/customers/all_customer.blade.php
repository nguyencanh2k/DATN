@extends('admin_layout')
@section('admin_content')
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
                            <th scope="col"></th>
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
                        <form action="{{url('/assign-roles')}}" method="POST">
                        @csrf
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
                                    <a href="{{URL::to('/unactive-customer/'.$cus->customer_id)}}"><span class="btn-rounded btn-success btn">Hoạt động</span></a>
                                <?php
                                    }else{
                                ?>  
                                    <a href="{{URL::to('/active-customer/'.$cus->customer_id)}}"><span class="btn-rounded btn-danger btn">Khóa</span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{url('/edit-customer-ad/'.$cus->customer_id)}}">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="{{url('/delete-customer-ad/'.$cus->customer_id)}}">Xóa</a>
                            </td> 
                        </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="bootstrap-pagination">
                <nav>
                    <ul class="pagination justify-content-center">
                        {!!$all_customer_ad->links()!!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
@endsection