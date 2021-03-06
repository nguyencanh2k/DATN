@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê danh mục bài viết</h4>
                    
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
                                    <th scope="col">Tên danh mục bài viết</th>
                                    <th scope="col">Mô tả danh mục bài viết</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($category_post as $key => $cate_post)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$cate_post->cate_post_name}}</td>
                                    <td>{!!$cate_post->cate_post_desc!!}</td>
                                    <td>{{$cate_post->cate_post_slug}}</td>
                                    <td>
                                        @if($cate_post->cate_post_status==0)
                                            <a href="{{URL::to('/unactive-category-post/'.$cate_post->cate_post_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                        @else
                                            <a href="{{URL::to('/active-category-post/'.$cate_post->cate_post_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
                                        @endif
                                    </td>
                                    <td><span>
                                        <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                        <a href="{{URL::to('/delete-category-post/'.$cate_post->cate_post_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục bài viết này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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