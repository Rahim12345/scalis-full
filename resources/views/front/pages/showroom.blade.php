@extends('front.layout.master')

@section('title') {{ __('menus.products') }} @endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('scalis/css/fancybox.min.css') }}">
@endsection

@section('content')
    <div class="main-full">
        <!--PRODUCT BANNER SECTION========================-->
        <section class="product-banner banner-img fix">
            <div class="img container-fluid">
                <div
                    class="banner-img wow animate__animated animate__fadeIn animate__fast"
                >
                    <img src="{{ asset('files/showroom/'.\App\Helpers\Options::getOption('show_banner')) }}" alt="" />
                </div>
            </div>
            <div class="text container-fluid">
                <div class="banner-text">
                    <h1
                        class="banner-title wow animate__animated animate__slideInLeft animate__fast"
                    >
                        Showroom
                    </h1>
                </div>
            </div>
        </section>
        <!--PRODUCT BANNER SECTION========================-->
        <!--CHOOSE SECTION========================-->
        <div class="contact_page fix" style="background-color: #fff">
            <div class="container">
                <div class="about-text">
                    <h1
                        class="about-title wow animate__animated animate__zoomIn animate__slow"
                    >
                        Showroom
                    </h1>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <!--CHOOSE SECTION========================-->
        <!--CONTACT BODY SECTION========================-->
        <section class="showrooms">
            <div class="container-fluid">
                <div class="main_showrooms">
                    <div class="showrooms_bottom">
                        <div class="alt_showrooms">
                            @foreach($fotos as $foto)
                            <a data-fancybox="gallery" href="{{ asset('files/fotos/'.$foto->src) }}">
                                <figure class="showrooms_one" >
                                    <img src="{{ asset('files/fotos/'.$foto->src) }}"  alt="">
                                    <figcaption>
                                        <i class="search far fa-search-plus"></i>
                                    </figcaption>
                                </figure>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--CONTACT BODY SECTION========================-->
        @include('front.includes.contact-details')
    </div>
@endsection

@section('js')
    <script src="{{ asset('front/js/contact.js') }}"></script>
    <script src="{{ asset('scalis/js/fancybox.min.js') }}"></script>
@endsection
