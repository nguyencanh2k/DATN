@extends('admin_layout')
@section('admin_content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{URL::to('/manage-order')}}">Chi tiết đơn hàng</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                    <h4 class="card-title">Thông tin khách hàng</h4>
                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Tên khách hàng:</strong> <span>{{$customer->customer_name}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Email:</strong> <span>{{$customer->customer_email}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Số điện thoại:</strong> <span>{{$customer->customer_phone}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <?php
                        $message= Session::get('message');
                        if($message){
                            echo '<span class="text-alert text-danger">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                    <h4 class="card-title">Thông tin vận chuyển</h4>
                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Tên người nhận:</strong> <span>{{$shipping->shipping_name}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Địa chỉ:</strong> <span>{{$shipping->shipping_address}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Số điện thoại:</strong> <span>{{$shipping->shipping_phone}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Email:</strong> <span>{{$shipping->shipping_email}}</span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Ghi chú:</strong> 
                            <span>
                                @if($shipping->shipping_notes !=null) {{$shipping->shipping_notes}}
                                @else Không có
                                @endif
                            </span>
                        </li>
                        <li class="mb-1"><strong class="text-dark mr-4">Hình thức thanh toán:</strong> 
                            <span>
                                @if($shipping->shipping_method==0) Thanh toán khi nhận hàng 
                                @else Thanh toán bằng thẻ ngân hàng
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liệt kê chi tiết đơn hàng</h4>
                    
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
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Số lượng sản phẩm trong kho</th>
                                    <th scope="col">Mã giảm giá</th>
                                    <th scope="col">Phí ship</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá sản phẩm</th>
                                    <th scope="col">Giá gốc</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                    $total = 0;
                                @endphp
                                @foreach($order_details as $key => $details)
                                @php
                                    $i++;
                                    $subtotal = $details->product_price*$details->product_sales_quantity;
                                    $total+=$subtotal;
                                @endphp
                                <tr class="color_qty_{{$details->product_id}}">
                                    <td>{{$i}}</td>
                                    <td>{{$details->product_name}}</td>
                                    <td>{{$details->product->product_quantity}}</td>
                                    <td>@if($details->product_coupon!='no')
                                        {{$details->product_coupon}}
                                      @else 
                                        Không có
                                      @endif
                                    </td>
                                    <td>{{number_format($details->product_feeship ,0,',','.')}}đ</td>
                                    <td>
                                        <input type="number" min="1" readonly value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                                        {{-- <input type="hidden" name="order_qty_storage" value="{{$details->product->product_quantity}}"> --}}
        
                                        <input type="hidden" name="order_id" class="order_id" value="{{$details->order_id}}">
                          
                                        <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
        
                                    </td>
                                    <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
                                    <td>{{number_format($details->product->price_cost ,0,',','.')}}đ</td>
                                    <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="9">
                                        @php 
                                            $total_coupon = 0;
                                        @endphp
                                        @if($coupon_condition==1)
                                            @php
                                            $total_after_coupon = ($total*$coupon_number)/100;
                                            echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').' đ'.'</br>';
                                            $total_coupon = $total - $total_after_coupon ;
                                            @endphp
                                        @else 
                                            @php
                                            echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' đ'.'</br>';
                                            $total_coupon = $total - $coupon_number ;
        
                                            @endphp
                                        @endif
                                        Thanh toán: {{number_format($total_coupon,0,',','.')}} đ     
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                      @foreach($order as $key => $or)
                                        @if($or->order_status==1)
                                        <form>
                                           @csrf
                                          <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                                            <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                            <option id="{{$or->order_id}}" value="3">Đơn hàng bị hủy</option>
                                          </select>
                                        </form>
                                        @elseif($or->order_status==2)
                                        <form>
                                          @csrf
                                          <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                            <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                                            <option disabled id="{{$or->order_id}}" value="3">Đơn hàng bị hủy</option>
                                          </select>
                                        </form>
                                        @else
                                        <form>
                                          @csrf
                                          <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                            <option disabled id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                            <option id="{{$or->order_id}}" selected value="3">Đơn hàng bị hủy</option>
                                          </select>
                                        </form>
                                        @endif
                                        @endforeach
                        
                        
                                    </td>
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                    <a target="_blank" href="{{url('/print-order/'.$details->order_id)}}">In đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection