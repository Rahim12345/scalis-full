@extends('front.layout.master')

@section('title') {{ __('menus.about') }} @endsection
@section('css')
    <style>
        p {
            font-family: 'Montserrat', sans-serif !important;
        }
        strong {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: bold;
        }
        @media screen and (max-width: 550px) {
            img{
                width: 100% !important;
                height:auto !important;
                align: center !important;
                display:block !important;
                margin: 0 auto !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="main-full">
        <!--PRODUCT BANNER SECTION========================-->
        <section class="product-banner banner-img fix">
            <div class="img container-fluid">
                <div class="banner-img wow animate__ animate__fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <img src="{{ asset('files/about/'.\App\Helpers\Options::getOption('about_banner')) }}" alt="">
                </div>
            </div>
            <div class="text container-fluid">
                <div class="banner-text">
                    <h1 class="banner-title wow animate__ animate__slideInLeft animate__fast" style="visibility: visible; animation-name: slideInLeft;">{{ __('menus.about') }}</h1>
                </div>
            </div>
        </section>
        <section class="about_page fix">
            <div class="container-fluid">
                @php
                    $count = $about->count();
                @endphp
                @for($i = 1; $i <= $count; $i++)
                    @if($i%2 == 0)
                        <div class="row">
                            <div class="about_page_imag wow animate__animated animate__fadeInRight" data-wow-duration="1s">
                                <img src="{{ asset('files/about/'.$about[$i-1]->banner_image) }}" alt="">
                            </div>
                            <div class="about_page_text wow animate__animated animate__fadeInLeft" data-wow-duration="1s">
                                {!! $about !== null ? $about[$i-1]->{'about_us_'.app()->getLocale()} : '' !!}
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="about_page_imag wow animate__animated animate__fadeInLeft" data-wow-duration="1s">
                                <img src="{{ asset('files/about/'.$about[$i-1]->banner_image) }}" alt="">
                            </div>
                            <div class="about_page_text wow animate__animated animate__fadeInRight " data-wow-duration="1s">
                                {!! $about !== null ? $about[$i-1]->{'about_us_'.app()->getLocale()} : '' !!}
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </section>
        <!--PRODUCT BANNER SECTION========================-->
        @include('front.includes.contact-details')
    </div>
@endsection

@section('js')

@endsection
