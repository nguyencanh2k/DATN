<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{asset('public/backend/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/formValidation.min.css')}}" rel="stylesheet">

</head>

<body>


    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{URL::to('/dashboard')}}">
                    <b class="logo-abbr"><img src="{{asset('public/backend/images/logo.png')}}" alt=""> </b>
                    <span class="logo-compact"><img src="{{asset('public/backend/images/logo-compact.png')}}" alt=""></span>
                    <span class="brand-title">
                        <img src="{{asset('public/backend/images/logo-text.png')}}" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons d-none d-md-flex" data-toggle="dropdown">
                            <a href="javascript:void(0)" class="log-user">
                                <span>
                                    <?php
                                        $name= Auth::user()->admin_name;
                                        if($name){
                                            echo "Hi, ".$name;
                                        }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset('public/backend/images/user/yuta.jpg')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                       
                                        <li><a href="{{URL::to('/logout-auth')}}"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Danh mục sản phẩm</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục</a></li>
                            <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Thương hiệu sản phẩm</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu</a></li>
                            <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Sản phẩm</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                            <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Danh mục bài viết</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
                            <li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Quản lý bài viết</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
                            <li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Đơn hàng</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Mã giảm giá</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                            <li><a href="{{URL::to('/list-coupon')}}">Quản lý mã giảm giá</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Vận chuyển</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Slider</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-slider')}}">Thêm Slider</a></li>
                            <li><a href="{{URL::to('/manage-slider')}}">Quản lý Slider</a></li>
                        </ul>
                    </li>
                    @hasrole(['admin', 'author'])
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-list-ul"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('/add-users')}}">Thêm User</a></li>
                            <li><a href="{{URL::to('/users')}}">Quản lý User</a></li>
                        </ul>
                    </li>
                    @endhasrole
                    
                    @impersonate
                    <li class="nav-label">
                        <a href="{{URL::to('/impersonate-destroy')}}" aria-expanded="false">
                            Về tài khoản của bạn
                        </a>
                    </li>
                    @endimpersonate
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                @yield('admin_content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('public/backend/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('public/backend/js/custom.min.js')}}"></script>
    <script src="{{asset('public/backend/js/settings.js')}}"></script>
    <script src="{{asset('public/backend/js/gleek.js')}}"></script>
    <script src="{{asset('public/backend/js/styleSwitcher.js')}}"></script>

    <!-- Chartjs -->
    <script src="{{asset('public/backend/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Circle progress -->
    <script src="{{asset('public/backend/plugins/circle-progress/circle-progress.min.js')}}"></script>
    <!-- Datamap -->
    <script src="{{asset('public/backend/plugins/d3v3/index.js')}}"></script>
    <script src="{{asset('public/backend/plugins/topojson/topojson.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/datamaps/datamaps.world.min.js')}}"></script>
    <!-- Morrisjs -->
    <script src="{{asset('public/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/morris/morris.min.js')}}"></script>
    <!-- Pignose Calender -->
    <script src="{{asset('public/backend/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
    <!-- ChartistJS -->
    <script src="{{asset('public/backend/plugins/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>



    <script src="{{asset('public/backend/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
         CKEDITOR.replace('ckeditor');
         CKEDITOR.replace('ckeditor1');
         CKEDITOR.replace('ckeditor2');
         CKEDITOR.replace('ckeditor3');
         CKEDITOR.replace('ckeditor4');
         CKEDITOR.replace('ckeditor5');
         CKEDITOR.replace('ckeditor6');
         CKEDITOR.replace('ckeditor7');
         CKEDITOR.replace('ckeditor8');
         CKEDITOR.replace('ckeditor9');
         CKEDITOR.replace('ckeditor10');
         CKEDITOR.replace('ckeditor11');
         CKEDITOR.replace('ckeditor12');
         CKEDITOR.replace('ckeditor13');
         CKEDITOR.replace('ckeditor14');
         CKEDITOR.replace('ckeditor15');
         CKEDITOR.replace('ckeditor16');
         CKEDITOR.replace('ckeditor17');
    </script>
    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({
            
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
    
            fetch_delivery();
    
            function fetch_delivery(){
                var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url : '{{url('/select-feeship')}}',
                    method: 'POST',
                    data:{_token:_token},
                    success:function(data){
                       $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur','.fee_feeship_edit',function(){
    
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('/update-delivery')}}',
                    method: 'POST',
                    data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                    success:function(data){
                       fetch_delivery();
                    }
                });
    
            });
            $('.add_delivery').click(function(){
    
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('/insert-delivery')}}',
                    method: 'POST',
                    data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                    success:function(data){
                       fetch_delivery();
                    }
                });
    
    
            });
            $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
    
                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : '{{url('/select-delivery')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                       $('#'+result).html(data);     
                    }
                });
            }); 
        })
    
    
    </script>
    <script type="text/javascript">
        $('.update_quantity_order').click(function(){
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            $.ajax({
                    url : '{{url('/update-qty')}}',
    
                    method: 'POST',
    
                    data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                    // dataType:"JSON",
                    success:function(data){
    
                        alert('Cập nhật số lượng thành công');
                     
                       location.reload();
                        
                  
                        
    
                    }
            });
    
        });
    </script>
    <script type="text/javascript">
        $('.order_details').change(function(){
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            //lay ra so luong sp khach dat
            quantity = [];
            $("input[name='product_sales_quantity']").each(function(){
                quantity.push($(this).val());
            });
            //lay ra product id de so sanh
            order_product_id = [];
            $("input[name='order_product_id']").each(function(){
                order_product_id.push($(this).val());
            });
            j = 0;
            for(i=0;i<order_product_id.length;i++){
                //so luong khach dat
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //so luong ton kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if(parseInt(order_qty)>parseInt(order_qty_storage)){
                    j = j + 1;
                    if(j==1){
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_'+order_product_id[i]).css('background','#000');
                }
            }
            if(j==0){
            
                    $.ajax({
                            url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                    });
                
            }

        });
    </script>
</body>

</html>