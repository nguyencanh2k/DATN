@extends('admin_layout')
@section('admin_content')
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
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">Duyệt</th>
                            <th scope="col">Tên người gửi</th>
                            <th scope="col">Bình luận</th>
                            <th scope="col">Ngày gửi</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comment as $key => $comm)
                        <tr>
                            <td>
                                @if($comm->comment_status==1)
                                    <input type="button" data-comment_id="{{$comm->comment_id}}" data-comment_status="0" id="{{$comm->comment_product_id}}" value="Duyệt" class="btn btn-primary btn-sm comment_duyet_btn">
                                @else
                                    <input type="button" data-comment_id="{{$comm->comment_id}}" data-comment_status="1" id="{{$comm->comment_product_id}}" value="Bỏ duyệt" class="btn btn-danger btn-sm comment_duyet_btn">
                                @endif
                            </td>
                            <td>{{$comm->comment_name}}</td>
                            <td>{{$comm->comment}} <br>
                                <ul>Trả lời: 
                                    @foreach ($comment_rep as $key => $comm_reply)
                                    @if($comm_reply->comment_parent_comment==$comm->comment_id)
                                        <li style="margin-left: 40px; color:blue;list-style-type:decimal">{{$comm_reply->comment}}</li>
                                    @endif
                                    @endforeach
                                </ul>
                                @if($comm->comment_status==0)
                                <textarea name="" class="form-control reply_comment_{{$comm->comment_id}}" id="" cols="60" rows="3"></textarea><br>
                                <input type="button" class="btn btn-default btn-sm btn-reply-comment" data-comment_id="{{$comm->comment_id}}" data-product_id="{{$comm->comment_product_id}}" value="Trả lời">
                                @endif
                            </td>
                            <td>{{$comm->comment_date}}</td>
                            <td><a href="{{url('/chi-tiet-san-pham/'.$comm->product->product_id)}}" target="_blank" rel="noopener noreferrer">{{$comm->product->product_name}}</a></td>
                            <td><span>
                                <a href=" " data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                <a href=" " onclick="return confirm('Bạn có chắc là muốn xóa bình luận này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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