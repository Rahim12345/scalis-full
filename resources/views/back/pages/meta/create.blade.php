@extends('back.layout.master')

@section('title') Blog @endsection

@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')
        <div class="container-xl mt-3" style="min-height: 70vh">
            <div class="row row-cards">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="content p-3">
                            <form action="{{ route('meta.store') }}" id="contact-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label" for="menus">Menu</label>
                                    <select name="menus" id="menus" class="form-control">
                                        <option value="main_page">{{ __('menus.home') }}</option>
                                        <option value="about_page">{{ __('menus.about') }}</option>
                                        <option value="brends_page">{{ __('menus.brends') }}</option>
                                        <option value="career_page">{{ __('menus.career') }}</option>
                                        <option value="contact_page">{{ __('menus.contact') }}</option>
                                    </select>
                                    @error('menus')
                                    <small class="text-danger" id="menus-error">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name_title">{{ '<meta name="title" content=" ? ">' }}</label>
                                    <input type="text" name="name_title" id="name_title" class="form-control w-100 @error('name_title') is-invalid  @enderror" value="{{ old('name_title') }}">
                                    @error('name_title')
                                    <small class="text-danger" id="name_title-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="name_description">{{ '<meta name="description" content=" ? ">' }}</label>
                                    <input type="text" name="name_description" id="name_description" class="form-control w-100 @error('name_description') is-invalid  @enderror" value="{{ old('name_description') }}">
                                    @error('name_description')
                                    <small class="text-danger" id="name_description-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_og_site_name">{{ '<meta property="og:site_name" content=" ? " />' }}</label>
                                    <input type="text" name="property_og_site_name" id="property_og_site_name" class="form-control w-100 @error('property_og_site_name') is-invalid  @enderror" value="{{ old('property_og_site_name') }}">
                                    @error('property_og_site_name')
                                    <small class="text-danger" id="property_og_site_name-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_og_url">{{ '<meta property="og:url" content=" ? ">' }}</label>
                                    <input type="text" name="property_og_url" id="property_og_url" class="form-control w-100 @error('property_og_url') is-invalid  @enderror" value="{{ old('property_og_url') }}">
                                    @error('property_og_url')
                                    <small class="text-danger" id="property_og_url-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_og_title">{{ '<meta property="og:title" content=" ? ">' }}</label>
                                    <input type="text" name="property_og_title" id="property_og_title" class="form-control w-100 @error('property_og_title') is-invalid  @enderror" value="{{ old('property_og_title') }}">
                                    @error('property_og_title')
                                    <small class="text-danger" id="property_og_title-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_og_description">{{ '<meta property="og:description" content=" ? ">' }}</label>
                                    <input type="text" name="property_og_description" id="property_og_description" class="form-control w-100 @error('property_og_description') is-invalid  @enderror" value="{{ old('property_og_description') }}">
                                    @error('property_og_description')
                                    <small class="text-danger" id="property_og_description-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_twitter_url">{{ '<meta property="twitter:url" content=" ? ">' }}</label>
                                    <input type="text" name="property_twitter_url" id="property_twitter_url" class="form-control w-100 @error('property_twitter_url') is-invalid  @enderror" value="{{ old('property_twitter_url') }}">
                                    @error('property_twitter_url')
                                    <small class="text-danger" id="property_twitter_url-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_twitter_title">{{ '<meta property="twitter:title" content=" ? ">' }}</label>
                                    <input type="text" name="property_twitter_title" id="property_twitter_title" class="form-control w-100 @error('property_twitter_title') is-invalid  @enderror" value="{{ old('property_twitter_title') }}">
                                    @error('property_twitter_title')
                                    <small class="text-danger" id="property_twitter_title-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="property_twitter_description">{{ '<meta property="twitter:description" content=" ? ">' }}</label>
                                    <input type="text" name="property_twitter_description" id="property_twitter_description" class="form-control w-100 @error('property_twitter_description') is-invalid  @enderror" value="{{ old('property_twitter_description') }}">
                                    @error('property_twitter_description')
                                    <small class="text-danger" id="property_twitter_description-error">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group mb-3">
                                    <button class="btn btn-primary float-end" type="submit">Əlavə et</button>
                                </div>
                            </form>
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
