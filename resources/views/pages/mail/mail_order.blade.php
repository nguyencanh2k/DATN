<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
    </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Chào {{$shipping_array['customer_name']}}</h2><br>
                    <h3>Mã đơn hàng {{$code['order_id']}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                        <strong>Thông tin người nhận</strong><br>
                            Email:
                            @if($shipping_array['shipping_email']=='')
                                Không có
                            @else
                                {{$shipping_array['shipping_email']}}
                            @endif
                            <br>
                            Tên người nhận: 
                            @if($shipping_array['shipping_name']=='')
                                Không có
                            @else
                                {{$shipping_array['shipping_name']}}
                            @endif
                            <br>
                            Địa chỉ:
                            @if($shipping_array['shipping_address']=='')
                                Không có
                            @else
                                {{$shipping_array['shipping_address']}}
                            @endif
                            <br>
                            Số điện thoại:
                            @if($shipping_array['shipping_phone']=='')
                                Không có
                            @else
                                {{$shipping_array['shipping_phone']}}
                            @endif
                            <br>
                            Ghi chú: 
                            @if($shipping_array['shipping_notes']=='')
                                Không có
                            @else
                                {{$shipping_array['shipping_notes']}}
                            @endif
                            <br>
                            Phương thức thanh toán: 
                            @if($shipping_array['shipping_method']==0)
                                Thanh toán bằng tiền mặt
                            @endif
                        </address>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Chi tiết đơn hàng</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Sản phẩm</strong></td>
                                        <td class="text-center"><strong>Giá</strong></td>
                                        <td class="text-center"><strong>Số lượng</strong></td>
                                        <td class="text-right"><strong>Thành tiền</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sub_total = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart_array as $cart)
                                        @php
                                            $sub_total = $cart['product_qty']*$cart['product_price'];
                                            $total+=$sub_total;
                                        @endphp
                                        <tr>
                                            <td>{{$cart['product_name']}}</td>
                                            <td class="text-center">{{number_format($cart['product_price'],0,',','.')}}đ</td>
                                            <td class="text-center">{{$cart['product_qty']}}</td>
                                            <td class="text-right">{{number_format($sub_total,0,',','.')}}đ</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Tổng tiền</strong></td>
                                        <td class="thick-line text-right">{{number_format($total,0,',','.')}}đ</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Mã giảm giá:</strong></td>
                                        <td class="no-line text-right">{{$code['coupon_code']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Tổng tiền thanh toán</strong></td>
                                        <td class="no-line text-right">{{number_format($code['grand_total'],0,',','.')}} đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>