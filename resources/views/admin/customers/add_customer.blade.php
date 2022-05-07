@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm khách hàng</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('save-customer-ad')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên khách hàng</label>
                        <div class="col-sm-10">
                            <input type="text" name="customer_name" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="customer_email" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" name="customer_phone" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" name="customer_password" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_customer" class="btn btn-dark">Thêm khách hàng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection