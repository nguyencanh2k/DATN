@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Liệt kê thương hiệu sản phẩm</h4>
            
            <div class="table-responsive"> 
                <?php
                $message= Session::get('message');
                if($message){
                    echo '<span class="text-alert text-danger">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-bordered table-striped verticle-middle"  id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên thương hiệu</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <style>
                        #category_order .ui-state-highlight{
                            padding: 24px;
                            background-color: #ffffcc;
                            border: 1px dotted #ccc;
                            cursor: move;
                            margin-top: 12px;
                        }
                    </style>
                    <tbody id="brand_order">
                        @foreach ($all_brand_product as $key => $brand)
                        <tr id="{{$brand->brand_id}}">
                            <td>{{$brand->brand_order}}</td>
                            <td>{{$brand->brand_name}}</td>
                            <td>
                                <?php
                                    if($brand->brand_status==0){
                                ?>
                                    <a href="{{URL::to('/unactive-brand-product/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                                    }else{
                                ?>  
                                    <a href="{{URL::to('/active-brand-product/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><span>
                                <a href="{{URL::to('/edit-brand-product/'.$brand->brand_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                <a href="{{URL::to('/delete-brand-product/'.$brand->brand_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="" method="post">
                    @csrf
                </form>
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
                        {!!$all_brand_product->links()!!}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
@endsection