<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Watch Store</h2>
    <h4>Watch Store gửi tới bạn mã giảm giá: {{$coupon_mail['coupon_code']}}</h4>
    @if($coupon_mail['coupon_condition']== 1)
        <h4>Mã có giá trị giảm {{$coupon_mail['coupon_number']}}%</h4>
    @else
        <h4>Mã có giá trị giảm {{number_format($coupon_mail['coupon_number'],0,',','.')}}đ</h4>
    @endif
    <h4>Ngày hết hạn: {{$coupon_mail['coupon_date_end']}}</h4>
</body>
</html>