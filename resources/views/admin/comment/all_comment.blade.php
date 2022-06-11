@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-comment')}}">Liệt kê bình luận</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê bình luận</h4>
                    <div id="notify_comment"></div>
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
                                    <th scope="col">Tên người bình luận</th>
                                    <th scope="col">Bình luận</th>
                                    <th scope="col">Ngày gửi</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($comment as $key => $cmt)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$cmt->comment_name}}</td>
                                    <td><b style="color: red">{{$cmt->comment}}</b> <br>
                                        <ul>Trả lời: 
                                            @foreach ($comment_reply as $key => $cmt_reply)
                                            @if($cmt_reply->comment_parent==$cmt->comment_id)
                                                <li style="margin-left: 40px; color:blue;list-style-type:decimal">{{$cmt_reply->comment}}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        <form action="{{URL::to('/reply-comment')}}" method="post">
                                            @csrf
                                            <textarea name="reply_comment" class="form-control" cols="60" rows="3"></textarea><br>
                                            <input type="hidden" name="comment_id" value="{{$cmt->comment_id}}">
                                            <input type="hidden" name="product_id" value="{{$cmt->product_id}}">
                                            <input type="submit" class="btn btn-default btn-sm btn-reply-comment" value="Trả lời">
                                        </form>
                                    </td>
                                    <td>{{$cmt->created_at}}</td>
                                    <td><a href="{{url('/chi-tiet-san-pham/'.$cmt->product->product_id)}}" target="_blank" rel="noopener noreferrer">{{$cmt->product->product_name}}</a></td>
                                    <td><span>
                                        <a href="{{URL::to('/delete-comment/'.$cmt->comment_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa bình luận này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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