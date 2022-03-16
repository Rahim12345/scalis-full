@extends('front.layout.master')

@section('title') {{ $blog->{'title_'.app()->getLocale()} }} @endsection
@section('css')

@endsection

@section('content')
    <div class="main-full">
        <!--PRODUCT BANNER SECTION========================-->
        <section class="product-banner banner-img fix">
            <div class="img container-fluid">
                <div
                    class="banner-img wow animate__animated animate__fadeIn animate__fast"
                >
                    <img src="{{ asset('files/blogs/'.\App\Helpers\Options::getOption('blog_banner')) }}" alt="" />
                </div>
            </div>
            <div class="text container-fluid">
                <div class="banner-text">
                    <h1
                        class="banner-title wow animate__animated animate__slideInLeft animate__fast"
                    >
                        {{ __('static.blog') }}
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
                        {{ __('static.blog') }}
                    </h1>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <!--CHOOSE SECTION========================-->
        <!--CONTACT BODY SECTION========================-->
        <section class="blog_one">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 image">
                        <figure class="effect-oscar" >
                            <img src="{{ asset($blog->cover) }}" alt="img09" />
                            <figcaption></figcaption>
                        </figure>
                    </div>
                    <div class="col-md-12 text">
                        <h2>{{ $blog->{'title_'.app()->getLocale()} }}</h2>
                        <p>
                            {!! $blog->{'content_'.app()->getLocale()} !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        @include('front.includes.contact-details')
    </div>
@endsection

@section('js')

@endsection
