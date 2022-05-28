@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm mã giảm giá</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('/insert-coupon-code')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_name" class="form-control" placeholder="Tên mã giảm giá" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_code" class="form-control" placeholder="Mã giảm giá" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_date_start" id="mdate3" class="form-control" placeholder="Ngày bắt đầu" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ngày kết thúc</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_date_end" id="mdate4" class="form-control" placeholder="Ngày kết thúc" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_time" class="form-control" placeholder="Số lượng" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tính năng mã</label>
                        <div class="col-sm-10 form-group">
                            <select name="coupon_condition" class="form-control">
                                <option value="0">-----Chọn-----</option>
                                <option value="1">Giảm theo %</option>
                                <option value="2">Giảm theo $</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nhập số % hoặc $ giảm</label>
                        <div class="col-sm-10">
                            <input type="text" name="coupon_number" class="form-control" placeholder="Nhập số % hoặc $ giảm" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" name="add_coupon" class="btn btn-dark">Thêm mã giảm giá</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection