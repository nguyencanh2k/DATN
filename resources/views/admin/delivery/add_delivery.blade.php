@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phí vận chuyển</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form>
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Chọn thành phố</label>
                        <div class="col-sm-10 form-group">
                            <select name="city" id="city" class="form-control choose city">
                                <option value="0">---Chọn thành phố---</option>
                                @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Chọn quận huyện</label>
                        <div class="col-sm-10 form-group">
                            <select name="province" id="province" class="form-control choose province">
                                <option value="0">----Chọn quận huyện----</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Chọn xã phường</label>
                        <div class="col-sm-10 form-group">
                            <select name="wards" id="wards" class="form-control wards">
                                <option value="0">----Chọn xã phường----</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phí vận chuyển</label>
                        <div class="col-sm-10">
                            <input type="text" name="fee_ship" class="form-control fee_ship" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="button" name="add_delivery" class="btn btn-dark add_delivery">Thêm phí vận chuyển</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="load_delivery">
                                
            </div>
        </div>
    </div>
</div>
@endsection