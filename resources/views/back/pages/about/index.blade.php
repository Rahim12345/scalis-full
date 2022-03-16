@extends('back.layout.master')

@section('title') {{ __('menus.about') }} @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')
        <div class="container-xl mt-3" style="min-height: 70vh">
            <div class="row row-cards">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <a href="{{ route('about.create') }}" class="btn btn-primary">Əlavə et</a>
                        <div class="content p-3">
                            <table class="table">
                                <tr>
                                    <td>Şəkil</td>
                                    <td>Text</td>
                                    <td></td>
                                </tr>
                                @foreach ($abouts as $about)
                                <tr>
                                    <td><img src="{{ asset('files/about/'.$about->banner_image) }}" alt=""></td>
                                    <td>{!! $about->{'about_us_'.app()->getLocale()} !!}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                            <a href="{{ route('about.edit',$about->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('about.destroy',$about->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
