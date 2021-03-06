@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
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
                                    <input type="text" name="product_name" class="form-control" placeholder="Tên sản phẩm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Số lượng sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" name="product_quantity" class="form-control" placeholder="Số lượng sản phẩm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giá nhập sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price_cost" class="form-control price_format" placeholder="Giá nhập sản phẩm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giá bán sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="text" name="product_price" class="form-control price_format" placeholder="Giá bán sản phẩm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="product_image" class="custom-file-input image-preview" onchange="previewFile(this);" required>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="http://aimory.vn/wp-content/uploads/2017/10/no-image.png" id="previewImg" width="30%" alt="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-150px" id="ckeditor" name="product_desc" rows="6" id="comment" placeholder="Mô tả sản phẩm" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nội dung sản phẩm</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-150px" id="ckeditor2" name="product_content" rows="6" id="comment" placeholder="Nội dung sản phẩm" required></textarea>
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
                                    <input type="text" data-role="tagsinput" name="product_tags" class="form-control" placeholder="Tags sản phẩm" required>
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
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" name="add_product" class="btn btn-dark">Thêm sản phẩm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection