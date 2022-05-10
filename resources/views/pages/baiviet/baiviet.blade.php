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
                        <li><a href="index.html">Home</a></li>
                        <li>Bài viết</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<!-- Shop Category Area End -->
<div class="shop-category-area single-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-lg-last col-md-12 order-md-first">
                @foreach($post_by_id as $key => $p)
                <div class="blog-posts">
                    <div class="single-blog-post blog-grid-post">
                        <div class="blog-post-media">
                            <div class="blog-image single-blog">
                                <a href="#"><img src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" /></a>
                            </div>
                        </div>
                        <div class="blog-post-content-inner">
                            <h4 class="blog-title"><a href="#">{{$p->post_title}}</a></h4>
                            <ul class="blog-page-meta">
                                <li>
                                    <a href="#"><i class="ion-person"></i> Admin</a>
                                </li>
                            </ul>
                            <p>
                                {!!$p->post_content!!}
                            </p>
                        </div>
                    </div>
                    <!-- single blog post -->
                </div>
                @endforeach
                <div class="blog-related-post">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!-- Section Title -->
                            <div class="section-title underline-shape">
                                <h2>Bài viết liên quan</h2>
                            </div>
                            <!-- Section Title -->
                        </div>
                    </div>
                    <div class="row">
                        @foreach($related as $key => $post_related)
                        <div class="col-md-4 mb-res-md-30px mb-res-sm-30px">
                            <div class="blog-post-media">
                                <div class="blog-image single-blog">
                                    <a href="{{URL::to('/bai-viet/'.$post_related->post_slug)}}"><img src="{{asset('public/uploads/post/'.$post_related->post_image)}}" alt="{{$post_related->post_slug}}" /></a>
                                </div>
                            </div>
                            <div class="blog-post-content-inner">
                                <h4 class="blog-title"><a href="{{URL::to('/bai-viet/'.$post_related->post_slug)}}">{{$post_related->post_title}}</a></h4>
                                <ul class="blog-page-meta">
                                    <li>
                                        <a href="#"><i class="ion-person"></i> Admin</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
