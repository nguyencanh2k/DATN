@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm bài viết</h4>
            
            <div class="basic-form">
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên bài viết</label>
                        <div class="col-sm-10">
                            <input type="text" name="post_title" class="form-control" placeholder="Tên bài viết" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="post_slug" class="form-control" placeholder="Slug" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tóm tắt bài viết</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="post_desc" rows="6" id="ckeditor"  placeholder="Tóm tắt bài viết" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nội dung bài viết</label>
                        <div class="col-sm-10">
                            <textarea class="form-control h-150px" name="post_content" rows="6" id="ckeditor2"  placeholder="Nội dung bài viết" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hình ảnh bài viết</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="post_image" class="custom-file-input image-preview" onchange="previewFile(this);" required>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <img src="http://aimory.vn/wp-content/uploads/2017/10/no-image.png" id="previewImg" width="30%" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danh mục bài viết</label>
                        <div class="col-sm-10 form-group">
                            <select name="cate_post_id" class="form-control">
                                @foreach ($cate_post as $key => $cate)
                                    <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hiển thị</label>
                        <div class="col-sm-10 form-group">
                            <select name="post_status" class="form-control">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" name="add_post" class="btn btn-dark">Thêm bài viết</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection