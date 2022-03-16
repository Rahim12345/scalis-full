@extends('front.layout.master')

@section('title') {{ __('menus.products') }} @endsection
@section('css')

@endsection

@section('content')
    <!--PRODUCT BANNER SECTION========================-->
    <section class="product_banner fix">
        <div class="col-lg-8 col-md-12">
            <div class="product_banner__gallery ">
                <div class="col-xl-2 col-lg-12 col-md-12">
                    <h4 class="first wow animate__animated animate__fadeInLeft animate__fast">{{ $product->capri }}</h4>
                </div>
                <div class="col-xl-10 col-lg-12 col-md-12 bannertext_p">
                    <p class="wow animate__animated animate__fadeInDown animate__fast">
                        @if(app()->getLocale() == 'az')
                            {{ explode('***',$product->agt)[0] }}
                        @elseif(app()->getLocale() == 'en')
                                {{ explode('***',$product->agt)[1] }}
                        @else
                                {{ explode('***',$product->agt)[2] }}
                        @endif
                    </p>
                    <h6 class="wow animate__animated animate__fadeInDown animate__fast"><span>Brend: </span> {{ $product->brend }}</h6>
                </div>
                <div class="imag wow animate__animated animate__fadeInLeft animate__fast">
                    <img src="{{ asset($product->center_image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-lg-4 bannerBottom">
            <div class="banner-video wow animate__animated animate__fadeInRight animate__fast">
                <div class="video-slider">
                    <a class="lightbox-image"
                       data-fancybox="gallery"
                       data-caption="" autoplay muted loop href="/video/video.mp4">
                        <i class="ripple"></i>
                    </a>
                </div>

                <video src="{{ asset($product->right_side_video) }}"  muted loop type="video/mp4"></video>
                <img src="{{ asset($product->right_side_image_1) }}" alt="">
            </div>


        </div>
    </section>
    <!--PRODUCT BANNER SECTION========================-->
    <!--PRODUCT SECTION========================-->
    <section class="product_section fix">
        <div class="technical-wrapper safe-area">
            <h2 class="wow animate__animated animate__fadeInLeft animate__fast">{{ __('static.texniki_ozellikler') }}</h2>
            <div class="technical-container">
                <div class="technical-info-block wow animate__animated animate__fadeInLeft animate__fast">
                    <div class="info-item">
                        <span class="name">{{ __('static.seth') }}</span>
                        <div class="desc-item">
                            <p>
                                @if(app()->getLocale() == 'az')
                                    {{ explode('***',$product->seth)[0] }}
                                @elseif(app()->getLocale() == 'en')
                                    {{ explode('***',$product->seth)[1] }}
                                @else
                                    {{ explode('***',$product->seth)[2] }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="name">{{ __('static.rengler') }}:</span>
                        <div class="desc-item">
                            <p>{{ $product->reng }}</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="name">{{ __('static.olculer') }}:</span>
                        <div class="desc-item">
                            <div class="size-info-block">
                                <div class="size-item">
                                    <span>{{ __('static.en') }}:</span>
                                    <p>{{ $product->en }} mm</p>
                                </div>
                                <div class="size-item">
                                    <span>{{ __('static.boy') }}:</span>
                                    <p>1220 mm</p>
                                </div>
                                <div class="size-item">
                                    <span>{{ __('static.qalinliq') }} (mm):</span>
                                    <p>{{ $product->qalinliq }} mm</p>
                                </div>
                                <div class="size-item">
                                    <span>{{ __('static.palitra') }}:</span>
                                    <p>{{ $product->palet }} {{ __('static.eded') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="technical-img-block ">
                    <div class="img-item">
                        <div class="lazyload-wrapper">
                            <img src="{{ asset($product->right_side_image_2) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--PRODUCT SECTION========================-->
    <!--PRODUCT DOUBLE SECTION========================-->
    <section class="product-double-root metro fix">
        <div class="double-wrapper safe-area">
            <div class="content-container certificate">
                <h2 class="wow animate__animated animate__fadeInLeft animate__fast">{{ __('static.sertifikatlar') }}</h2>
                <div class="content-block inside-slide-block wow animate__animated animate__fadeInUp animate__fast">
                    <div class="certificate-list-block " id="doubleCarousel">
                        @foreach($product->getSertifikatlar as $sertifikat)
                        <a class="swiper-slide">
                            <div class="certificate-list-block certificate-list-item">
                                <div class="certificate">
                                    <div class="img-item">
                                        <div class="lazyload-wrapper">
                                            <img src="{{ asset('files/products/sertifikatlar/'.$sertifikat->src) }}" alt="">
                                        </div>
                                    </div>
                                    <p>
                                        @if(app()->getLocale() == 'az')
                                            {{ explode('***',$sertifikat->name)[0] }}
                                        @elseif(app()->getLocale() == 'en')
                                            {{ explode('***',$sertifikat->name)[1] }}
                                        @elseif(app()->getLocale() == 'ru')
                                            {{ explode('***',$sertifikat->name)[2] }}
                                        @endif
                                    </p>
                                    <span>{{ $sertifikat->year }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="nav-body">
                <div class="nav-container">
                    <div class="nav-block">
                        <div class="arrow-icon left">

                        </div>
                        <!-- <span class="active"></span>
                        <span></span>
                        <span></span> -->
                        <div class="arrow-icon">

                        </div>

                    </div>
                </div>
            </div>
            <div class="content-container-f">
                <h2 class="wow animate__animated animate__fadeInLeft animate__fast">{{ __('static.dosyalar') }}</h2>
                <div class="content-block wow animate__animated animate__fadeInLeft animate__fast">
                    @foreach($product->getFiles as $file)
                    <a href="{{ asset('files/products/files/'.$file->src) }}" target="_blank" class="file-item pr-5" download="">
                        <div class="pdf-item">
                            <span>pdf</span>
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="text-item">
                            <p>
                                @if(app()->getLocale() == 'az')
                                    {{ explode('***',$file->name)[0] }}
                                @elseif(app()->getLocale() == 'en')
                                    {{ explode('***',$file->name)[1] }}
                                @elseif(app()->getLocale() == 'ru')
                                    {{ explode('***',$file->name)[2] }}
                                @endif
                            </p>
                            <span>{{ \Illuminate\Support\Facades\File::size(public_path('files/products/files/'.$file->src))/(1024 * 1024) >= 1 ? round(\Illuminate\Support\Facades\File::size(public_path('files/products/files/'.$file->src))/(1024 * 1024), 2) .' MB' : round(\Illuminate\Support\Facades\File::size(public_path('files/products/files/'.$file->src))/(1024), 2) .' KB'  }} </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>




    </section>
    <!--PRODUCT DOUBLE SECTION========================-->
    <!--CHOOSE SECTION========================-->
    @include('front.includes.contact-details')
    <!--CHOOSE SECTION========================-->
@endsection

@section('js')
    <script src="{{ asset('front/js/contact.js') }}"></script>
@endsection
