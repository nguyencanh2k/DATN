@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê sản phẩm</h4>
                    
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
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Thư viện ảnh</th>
                                    <th scope="col">Số lượng sản phẩm</th>
                                    <th scope="col">Giá nhập</th>
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Hình ảnh sản phẩm</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thương hiệu</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($all_product as $key => $pro)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$pro->product_name}}</td>
                                    <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm thư viện ảnh</a></td>
                                    <td>{{$pro->product_quantity}}</td>
                                    <td class="price_format">{{$pro->price_cost}}</td>
                                    <td class="price_format">{{$pro->product_price}}</td>
                                    <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100" alt=""></td>
                                    <td>{{$pro->category_name}}</td>
                                    <td>{{$pro->brand_name}}</td>
                                    <td>
                                        <?php
                                            if($pro->product_status==0){
                                        ?>
                                            <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="btn-rounded btn-outline-success btn"><b>Hiển thị</b></span></a>
                                        <?php
                                            }else{
                                        ?>  
                                            <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="btn-rounded btn-outline-danger btn"><b>Ẩn</b></span></a>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td><span>
                                        <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil text-success m-r-5"></i> </a>
                                        <a href="{{URL::to('/delete-product/'.$pro->product_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger ml-4"></i></a>
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