@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật sản phẩm</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                @foreach($edit_product as $key => $pro)
                <form action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_name" class="form-control" value="{{$pro->product_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Số lượng sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_quantity" class="form-control" value="{{$pro->product_quantity}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá nhập sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="price_cost" class="form-control price_format" value="{{$pro->price_cost}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá bán sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_price" class="form-control price_format" value="{{$pro->product_price}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="product_image" class="custom-file-input">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="product_desc" rows="6" id="ckeditor19" >{{$pro->product_desc}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nội dung sản phẩm</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="product_content" rows="6" id="ckeditor20"  >{{$pro->product_content}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tags sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" data-role="tagsinput" name="product_tags" class="form-control" value="{{$pro->product_tags}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
                        <div class="col-sm-10 form-group">
                            <select name="product_cate" class="form-control">
                                @foreach($cate_product as $key => $cate)
                                    @if($cate->category_id==$pro->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Thương hiệu</label>
                        <div class="col-sm-10 form-group">
                            <select name="product_brand" class="form-control">
                                @foreach($brand_product as $key => $brand)
                                    @if($brand->brand_id==$pro->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
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
                            <button type="submit" name="add_product" class="btn btn-dark">Cập nhật sản phẩm</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection