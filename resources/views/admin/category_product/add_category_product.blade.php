@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm danh mục sản phẩm</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('/save-category-product')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" name="category_product_name" class="form-control" placeholder="Tên danh mục">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả danh mục</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="category_product_desc" rows="6" id="ckeditor12"  placeholder="Mô tả danh mục"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Từ khóa danh mục</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="category_product_keywords" rows="6" id="ckeditor13"  placeholder="Mô tả danh mục"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>
                        <div class="col-sm-10 form-group">
                            <select name="category_product_status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_category_product" class="btn btn-dark">Thêm danh mục</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection