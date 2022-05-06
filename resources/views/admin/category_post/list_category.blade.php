@extends('admin_layout')
@section('admin_content')
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
                            <th scope="col">ID</th>
                            <th scope="col">Tên danh mục bài viết</th>
                            <th scope="col">Mô tả danh mục bài viết</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category_post as $key => $cate_post)
                        <tr>
                            <td>{{$cate_post->cate_post_id}}</td>
                            <td>{{$cate_post->cate_post_name}}</td>
                            <td>{{$cate_post->cate_post_desc}}</td>
                            <td>{{$cate_post->cate_post_slug}}</td>
                            <td>
                                @if($cate_post->cate_post_status==0)
                                    Hiển thị
                                @else
                                    Ẩn
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
{{-- <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="bootstrap-pagination">
                <nav>
                    <ul class="pagination justify-content-center">
                        {!!$category_post->links()!!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
@endsection