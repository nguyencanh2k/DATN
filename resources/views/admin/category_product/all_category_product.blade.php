@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê danh mục sản phẩm</h4>
                    
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
                                    <th scope="col">Tên danh mục</th>
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
                            <tbody id="category_order">
                                @foreach ($all_category_product as $key => $cate_pro)
                                    <tr id="{{$cate_pro->category_id}}">
                                        <td>{{$cate_pro->category_order}}</td>
                                        <td>{{$cate_pro->category_name}}</td>
                                        <td>
                                            <?php
                                                if($cate_pro->category_status==0){
                                            ?>
                                                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                            <?php
                                                }else{
                                            ?>  
                                                <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><span>
                                            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                            <a href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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
    </div>
</div>
@endsection