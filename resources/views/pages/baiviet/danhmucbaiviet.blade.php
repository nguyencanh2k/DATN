@extends('layout')
@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Danh mục bài viết</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="index.html">Home</a></li>
                        <li>Danh mục bài viết</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

@foreach($post as $key => $p)
<div class="shop-category-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-lg-last col-md-12 order-md-first">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-post-media">
                                <div class="blog-image">
                                    <a href="#"><img src="assets/images/blog-image/blog-1.jpg" alt="blog" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 align-self-center align-items-center">
                        <div class="blog-post-content-inner">
                            <h4 class="blog-title"><a href="#">This is Third Post For XipBlog</a></h4>
                            <ul class="blog-page-meta">
                                <li>
                                    <a href="#"><i class="ion-person"></i> Admin</a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-calendar"></i> 24 April, 2020</a>
                                </li>
                            </ul>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eius expedita hic, vel minima minus reiciendis consequuntur ab beatae necessitatibus amet magni itaque, nostrum vero eos nobis modi
                                temporibus recusandae.
                            </p>
                            <a class="read-more-btn" href="blog-single-left-sidebar.html"> Read More <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <!-- single blog post -->
                </div>
                <div class="pro-pagination-style text-center">
                    <ul>
                        <li>
                            <a class="prev" href="#"><i class="ion-ios-arrow-left"></i></a>
                        </li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li>
                            <a class="next" href="#"><i class="ion-ios-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
                <!--  Pagination Area End -->
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
