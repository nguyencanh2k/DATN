@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-post')}}">Cập nhật bài viết</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cập nhật bài viết</h4>
                    
                    <div class="basic-form">
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <form action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên bài viết</label>
                                <div class="col-sm-10">
                                    <input type="text" name="post_title" class="form-control" value="{{$post->post_title}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="post_slug" class="form-control" value="{{$post->post_slug}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tóm tắt bài viết</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-150px" name="post_desc" rows="6" id="ckeditor" required>{{$post->post_desc}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nội dung bài viết</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-150px" name="post_content" rows="6" id="ckeditor2" required>{{$post->post_content}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hình ảnh bài viết</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="post_image" class="custom-file-input image-preview" onchange="previewFile(this);">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="{{asset('public/uploads/post/'.$post->post_image)}}" id="previewImg" height="100" width="100">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Danh mục bài viết</label>
                                <div class="col-sm-10 form-group">
                                    <select name="cate_post_id" class="form-control">
                                        @foreach ($cate_post as $key => $cate)
                                            <option {{$post->cate_post_id==$cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Hiển thị</label>
                                <div class="col-sm-10 form-group">
                                    <select name="post_status" class="form-control">
                                        @if($post->post_status==0)
                                            <option selected value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                        @else
                                            <option value="0">Hiển thị</option>
                                            <option selected value="1">Ẩn</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="update_post" class="btn btn-dark">Cập nhật bài viết</button>
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