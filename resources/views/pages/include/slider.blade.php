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
                    <span class="animated">{!!$slide->slider_title!!}</span>
                    <h1 class="animated">
                        {!!$slide->slider_content!!}
                    </h1>
                    <p class="animated">{!!$slide->slider_subtitle!!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Slider Arae End -->