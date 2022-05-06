@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm sản phẩm</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_name" data-validation="length" data-validation-length="min3"
                             data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự" class="form-control" placeholder="Tên sản phẩm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số lượng sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_quantity" data-validation="number" 
                            data-validation-error-msg="Làm ơn điền số lượng" class="form-control" placeholder="Số lượng sản phẩm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá nhập sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="price_cost" class="form-control price_format" data-validation="length" 
                            data-validation-length="min5" data-validation-error-msg="Làm ơn điền số tiền" placeholder="Giá nhập sản phẩm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá bán sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_price" class="form-control price_format" data-validation="length" 
                            data-validation-length="min5" data-validation-error-msg="Làm ơn điền số tiền" placeholder="Giá bán sản phẩm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="product_image" class="custom-file-input image-preview" onchange="previewFile(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <img src="http://aimory.vn/wp-content/uploads/2017/10/no-image.png" id="previewImg" width="30%" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" id="ckeditor14" name="product_desc" rows="6" id="comment" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nội dung sản phẩm</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" id="ckeditor15" name="product_content" rows="6" id="comment" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
                        <div class="col-sm-10 form-group">
                            <select name="product_cate" class="form-control">
                                @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tags sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" data-role="tagsinput" name="product_tags" class="form-control" placeholder="Tags sản phẩm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Thương hiệu</label>
                        <div class="col-sm-10 form-group">
                            <select name="product_brand" class="form-control">
                                @foreach($brand_product as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>
                        <div class="col-sm-10 form-group">
                            <select name="product_status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_product" class="btn btn-dark">Thêm sản phẩm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection