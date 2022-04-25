<!-- Slider Arae Start -->
<div class="slider-area">
    <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
        <!-- Slider Single Item Start -->
        @php 
            $i = 0;
        @endphp
        @foreach($slider as $key => $slide)
        @php 
            $i++;
        @endphp
        <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img item {{$i==1 ? 'active' : '' }}" style="background-image: url({{asset('public/uploads/slider/'.$slide->slider_image)}}">
            <div class="container">
                <div class="slider-content-1 slider-animated-1 text-left">
                    <span class="animated">Máy cơ THỤY SĨ siêu mỏng</span>
                    <h1 class="animated">
                        Frederique <br />
                        Constant 2022
                    </h1>
                    <h1>{!!$slide->slider_desc!!}</h1>
                    <p class="animated">Hàng tuyển chọn rất kỹ</p>
                    {{-- <a href="#" class="shop-btn animated">Mua ngay</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Slider Arae End -->