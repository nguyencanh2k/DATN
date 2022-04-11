@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm danh mục bài viết</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('/save-category-post')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên danh mục bài viết</label>
                        <div class="col-sm-10">
                            <input type="text" name="cate_post_name" class="form-control" placeholder="Tên danh mục">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="cate_post_slug" class="form-control" placeholder="Tên danh mục">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mô tả danh mục bài viết</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="cate_post_desc" rows="6" id="ckeditor4"  placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>
                        <div class="col-sm-10 form-group">
                            <select name="cate_post_status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="add_post_cate" class="btn btn-dark">Thêm danh mục bài viết </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection