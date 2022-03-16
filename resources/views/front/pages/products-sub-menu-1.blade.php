@extends('front.layout.master')

@section('title') {{ __('menus.products') }} - {{ $main_menu->{'name_'.app()->getLocale()} }} - {{ $sub_menu_1->{'name_'.app()->getLocale()} }}  @endsection
@section('css')

@endsection

@section('content')
    <div class="main-full">
        <!--PRODUCT BANNER SECTION========================-->
        <section class="product-banner banner-img fix">
            <div class="img container-fluid">
                <div class="banner-img wow animate__animated animate__fadeIn animate__fast">
                    <img src="{{ asset('files/sub-1/'.$sub_menu_1->image) }}" alt="">
                </div>
            </div>
            <div class="text container-fluid">
                <div class="banner-text">
                    <h1 class="banner-title  wow animate__animated animate__slideInLeft animate__fast" >{{ $main_menu->{'name_'.app()->getLocale()} }}</h1>
                </div>
            </div>
        </section>
        <!--PRODUCT BANNER SECTION========================-->
        <!--PRODUCT SECTION========================-->
        <section class="products_section fix">
            <div class="container">
                <div class="about-text">
                    <h1 class="about-title wow animate__animated animate__zoomIn animate__fast">{{ $main_menu->{'name_'.app()->getLocale()} }}</h1>
                    <div class="line"></div>
                    <p class="wow animate__animated animate__fadeInUp">{{ $main_menu->{'description_'.app()->getLocale()} }}</p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 wow animate__animated animate__fadeInLeft animate__fast">
                        <div class="products_section_category ">
                            <h3>{{ $main_menu->{'name_'.app()->getLocale()} }}</h3>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($main_menu->sub_one_menus as $sub_one_menu)
                                    @if($sub_one_menu->slug_az == request()->segment(3) || $sub_one_menu->slug_en == request()->segment(3) || $sub_one_menu->slug_ru == request()->segment(3))
                                    <a class="nav-item nav-link active menus-item" href="{{ route('front.products.main_menu.sub_menu_1',['main_menu'=>$sub_one_menu->mainMenus->{'slug_'.app()->getLocale()},'sub_menu_1'=>$sub_one_menu->{'slug_'.app()->getLocale()} ]) }}">{{ $sub_one_menu->{'name_'.app()->getLocale()} }}</a>
                                    @else
                                    <a class="nav-item nav-link menus-item" href="{{ route('front.products.main_menu.sub_menu_1',['main_menu'=>$sub_one_menu->mainMenus->{'slug_'.app()->getLocale()},'sub_menu_1'=>$sub_one_menu->{'slug_'.app()->getLocale()} ]) }}">{{ $sub_one_menu->{'name_'.app()->getLocale()} }}</a>
                                    @endif
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                        <div class="products_section_category cat-two" >
                            <nav>
                                <div class="nav nav-tabs fade show active" id="nav-tab-two" role="tablist">
                                    @foreach($sub_menu_1->sub_two_menus as $sub_two_menu)
                                    @if($loop->first)
                                    <a class="nav-item nav-link active" href="{{ route('front.products.main_menu.sub_menu_1.sub_menu_2',['main_menu'=>$sub_two_menu->subMenuOne->mainMenus->{'slug_'.app()->getLocale()},'sub_menu_1'=>$sub_two_menu->subMenuOne->{'slug_'.app()->getLocale()},'sub_menu_2'=>$sub_two_menu->{'slug_'.app()->getLocale()}]) }}">{{ $sub_two_menu->{'name_'.app()->getLocale()} }}</a>
                                    @else
                                    <a class="nav-item nav-link" href="{{ route('front.products.main_menu.sub_menu_1.sub_menu_2',['main_menu'=>$sub_two_menu->subMenuOne->mainMenus->{'slug_'.app()->getLocale()},'sub_menu_1'=>$sub_two_menu->subMenuOne->{'slug_'.app()->getLocale()},'sub_menu_2'=>$sub_two_menu->{'slug_'.app()->getLocale()}]) }}">{{ $sub_two_menu->{'name_'.app()->getLocale()} }}</a>
                                    @endif
                                    @endforeach
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-9 wow animate__animated animate__fadeInRight animate__fast">
                        <div class="products_section_body"  id="nav-tabContent">
                            <div class="products-section_body_fra fade show active" id="nav-aa" role="tabpanel" aria-labelledby="nav-aa-tab">
                                <div class="col-lg-12 products_section_body_gallery">
                                    @if ($sub_menu_1->sub_two_menus->first() !== null)
                                    @foreach ($sub_menu_1->sub_two_menus->first()->getProducts as $product)
                                    <a href="{{ route('front.products.main_menu.sub_menu_1.sub_menu_2.product_slug',['main_menu'=>$sub_two_menu->subMenuOne->mainMenus->{'slug_'.app()->getLocale()},'sub_menu_1'=>$sub_two_menu->subMenuOne->{'slug_'.app()->getLocale()},'sub_menu_2'=>$sub_menu_1->sub_two_menus->first()->{'slug_'.app()->getLocale()},'product_slug'=>$product->slug_az]) }}">
                                        <div class="imag ">
                                            <img src="{{ asset($product->center_image) }}" alt="">
                                            <p>{{ $product->capri }}</p>
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--PRODUCT SECTION========================-->
        <!--CHOOSE SECTION========================-->
        @include('front.includes.contact-details')
        <!--CHOOSE SECTION========================-->
    </div>
@endsection

@section('js')
    <script src="{{ asset('front/js/contact.js') }}"></script>
@endsection
