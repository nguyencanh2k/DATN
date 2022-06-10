@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
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
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên slide</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Phụ đề</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($all_slide as $key => $slide)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$slide->slider_name}}</td>
                                    <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"></td>
                                    <td>{{$slide->slider_title}}</td>
                                    <td>{{$slide->slider_content}}</td>
                                    <td>{{$slide->slider_subtitle}}</td>
                                    <td>
                                        <?php
                                            if($slide->slider_status==0){
                                        ?>
                                            <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                        <?php
                                            }else{
                                        ?>  
                                            <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
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
    </div>
</div>
@endsection