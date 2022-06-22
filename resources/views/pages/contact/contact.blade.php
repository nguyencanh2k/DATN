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
                        <li>Liên hệ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
 <!-- contact area start -->
 <div class="contact-area mtb-60px">
    <div class="container">
        <div class="contact-map mb-10">
            <div id="mapidd"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7675421533263!2d105.8427667!3d21.0019533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x361af0b04fbf6f26!2zV2F0Y2hTdG9yZS52biAtIMSQ4buTbmcgaOG7kyBjaMOtbmggaMOjbmc!5e0!3m2!1svi!2s!4v1655622537379!5m2!1svi!2s" width="1410" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
        <div class="custom-row-2">
            <div class="col-lg-4 col-md-5">
                <div class="contact-info-wrap">
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p>+093 189 2222</p>
                            <p>+096 139 5555</p>
                        </div>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p><a href="#">watchstore.hotro@gmail.com</a></p>
                            <p><a href="#">watchstore.com</a></p>
                        </div>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p>Địa chỉ</p>
                            <p>228 Lê Thanh Nghị, Hai Bà Trưng, Hà Nội</p>
                        </div>
                    </div>
                    <div class="contact-social">
                        <h3>Follow Us</h3>
                        <div class="social-info">
                            <ul>
                                <li>
                                    <a href="#"><i class="ion-social-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-social-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-social-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-social-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ion-social-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="contact-form">
                    <div class="contact-title mb-30">
                        <h2>Liên hệ chúng tôi</h2>
                    </div>
                    <form class="contact-form-style" id="contact-form" action="" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <input name="name" placeholder="Tên*" type="text" />
                            </div>
                            <div class="col-lg-6">
                                <input name="email" placeholder="Email*" type="email" />
                            </div>
                            <div class="col-lg-12">
                                <input name="subject" placeholder="Địa chỉ*" type="text" />
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Thông tin cần tư vấn*"></textarea>
                                <button class="submit" type="submit">Gửi</button>
                            </div>
                        </div>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact area end -->

@endsection
