@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-category-product')}}">Cập nhật danh mục sản phẩm</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cập nhật danh mục sản phẩm</h4>
                    
                    <div class="basic-form">
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        @foreach($edit_category_product as $key => $edit_value)
                        <form action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên danh mục</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mô tả danh mục</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-150px" name="category_product_desc" rows="6" id="ckeditor" required>{{$edit_value->category_desc}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" name="update_category_product" class="btn btn-dark">Cập nhật danh mục</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection