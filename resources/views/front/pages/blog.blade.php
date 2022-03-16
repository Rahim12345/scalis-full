@extends('front.layout.master')

@section('title') {{ __('menus.about') }} @endsection
@section('css')

@endsection

@section('content')
    <div class="main-full">
        <!--PRODUCT BANNER SECTION========================-->
        <section class="product-banner banner-img fix">
            <div class="img container-fluid">
                <div class="banner-img wow animate__animated animate__fadeIn animate__fast">
                    <img src="{{ asset('files/blogs/'.\App\Helpers\Options::getOption('blog_banner')) }}" alt="">
                </div>
            </div>
            <div class="text container-fluid">
                <div class="banner-text">
                    <h1 class="banner-title wow animate__animated animate__slideInLeft animate__fast" >{{ __('static.blog') }}</h1>
                </div>
            </div>
        </section>
        <!--PRODUCT BANNER SECTION========================-->
        <!--CHOOSE SECTION========================-->
        <div class="contact_page fix" style="background-color: #fff;">
            <div class="container" >
                <div class="about-text">
                    <h1 class="about-title wow animate__animated animate__zoomIn animate__slow" >{{ __('static.blog') }}</h1>
                    <div class="line" ></div>
                </div>
            </div>
        </div>
        <!--CHOOSE SECTION========================-->
        <!--CONTACT BODY SECTION========================-->
        <section class="blog">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_blog">
                        <div class="blog_top">
                            <div class="col-lg-6 col-md-12 text">
                                <h2>{{ $firstBlog->{'title_'.app()->getLocale()} }}</h2>
                                <p>{{ $firstBlog->{'sub_title_'.app()->getLocale()} }}</p>
                                <button class="btn"  onclick="window.location.href='{!! route('front.blog.single',['slug'=>$firstBlog->{'slug_'.app()->getLocale()}]) !!}'">{{ __('static.etrafli') }}</button>
                            </div>
                            <div class="col-lg-6 col-md-12 image">
                                <figure class="effect-oscar" onclick="window.location.href='{!! route('front.blog.single',['slug'=>$firstBlog->{'slug_'.app()->getLocale()}]) !!}'">
                                    <img src="{{ asset($firstBlog->cover) }}" alt="img09">
                                    <figcaption>
                                    </figcaption>
                                </figure>

                            </div>
                        </div>
                        <div class="blog_bottom">
                            <h2>Bloqlar</h2>
                            <div class="alt_blogs" id="load_data">

                            </div>
                        </div>
                            <div id="load_data_message" class="loading "></div>
                    </div>


                </div>
            </div>
        </section>
        <!--CONTACT BODY SECTION========================-->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function()
            {
                var limit = 3; //The number of records to display per request
                var start = 1; //The starting pointer of the data
                var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active
                function load_country_data(limit, start, )
                {
                    $.ajax({
                        url:"{!! route('front.blog.post') !!}",
                        method:"POST",
                        data:{limit:limit, start:start},
                        cache:false,
                        success:function(data)
                        {
                            $('#load_data').append(data);
                            if(data == '')
                            {
                                $('#load_data_message').html("");
                                action = 'active';
                            }
                            else
                            {
                                $('#load_data_message').html("<img src='{!! asset('loading.gif') !!}' style='width:150px' alt=''>");
                                action = 'inactive';
                            }

                        }
                    });
                }

                if(action == 'inactive')
                {
                    action = 'active';
                    load_country_data(limit, start);
                }
                $(window).scroll(function(){
                    if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
                    {
                        action = 'active';
                        start = start + limit;
                        setTimeout(function(){
                            load_country_data(limit, start);
                        }, 1000);
                    }
                });
            });

    </script>
@endsection
