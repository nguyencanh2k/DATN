@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm slide</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form role="form" action="{{URL::to('/insert-slider')}}" enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên slide</label>
                        <div class="col-sm-10">
                            <input type="text" name="slider_name" class="form-control" placeholder="Tên slider">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hình ảnh</label>
                        <div class="col-sm-10">
                            <input type="file" name="slider_image" class="form-control" placeholder="Hình ảnh">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="slider_desc" rows="6" id="ckeditor4"  placeholder="Mô tả"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>
                        <div class="col-sm-10 form-group">
                            <select name="slider_status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_slider" class="btn btn-dark">Thêm slide</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection