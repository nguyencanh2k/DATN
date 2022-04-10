@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm User</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('store-users')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input type="text" name="admin_name" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="admin_email" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" name="admin_phone" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" name="admin_password" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_category_product" class="btn btn-dark">Thêm User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection