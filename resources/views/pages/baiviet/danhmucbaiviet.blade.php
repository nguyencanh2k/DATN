@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">{{$meta_title}}</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        <li>Danh mục bài viết</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="shop-category-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-lg-last col-md-12 order-md-first">
                @foreach($post as $key => $p)
                <div class="row mt-50">
                    <div class="col-lg-5 col-md-6">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-post-media">
                                <div class="blog-image">
                                    <a href="{{URL::to('/bai-viet/'.$p->post_slug)}}"><img src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 align-self-center align-items-center">
                        <div class="blog-post-content-inner">
                            <h4 class="blog-title"><a href="{{URL::to('/bai-viet/'.$p->post_slug)}}">{{$p->post_title}}</a></h4>
                            <ul class="blog-page-meta">
                                <li>
                                    <a href="#"><i class="ion-person"></i> Admin</a>
                                </li>
                            </ul>
                            <p>
                                {!!$p->post_desc!!}
                            </p>
                            <a class="read-more-btn" href="{{URL::to('/bai-viet/'.$p->post_slug)}}"> Đọc ngay <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <!-- single blog post -->
                </div>
                @endforeach
                <div class="pro-pagination-style text-center">
                    {{-- <ul>
                        <li><a class="active" href="#">{{$post->links()}}</a></li>
                    </ul> --}}
                </div>
                <!--  Pagination Area End -->
            </div>
        </div>
    </div>
</div>
@endsection
