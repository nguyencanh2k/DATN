@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liệt kê banner</h4>
            
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
                            <th scope="col">Tên slide</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_slide as $key => $slide)
                        <tr>
                            <td>{{$slide->slider_id}}</td>
                            <td>{{$slide->slider_name}}</td>
                            <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"></td>
                            <td>{{$slide->slider_desc}}</td>
                            <td>
                                <?php
                                    if($slide->slider_status==1){
                                ?>
                                    <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                                    }else{
                                ?>  
                                    <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><span>
                                <a href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection