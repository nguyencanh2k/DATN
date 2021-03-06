@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê bài viết</h4>
                    
                    <div class="table-responsive"> 
                        <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <table class="table table-bordered table-striped verticle-middle" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên bài viết</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Mô tả bài viết</th>
                                    <th scope="col">Danh mục bài viết</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($all_post as $key => $post)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$post->post_title}}</td>
                                    <td><img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100" alt=""></td>
                                    <td>{{$post->post_slug}}</td>
                                    <td>{!!$post->post_desc!!}</td>
                                    <td>{{$post->cate_post->cate_post_name}}</td>
                                    <td>
                                            @if($post->post_status==0)
                                                <a href="{{URL::to('/unactive-post/'.$post->post_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                            @else
                                                <a href="{{URL::to('/active-post/'.$post->post_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
                                            @endif
                                    </td>
                                    <td><span>
                                        <a href="{{URL::to('/edit-post/'.$post->post_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                        <a href="{{URL::to('/delete-post/'.$post->post_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa bài viết này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
                                    </span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection