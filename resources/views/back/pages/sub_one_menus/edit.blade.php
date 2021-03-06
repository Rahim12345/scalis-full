@extends('back.layout.master')

@section('title')  @endsection
@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
                <a href="{{ route('sub-one-menu.index') }}" class="btn btn-primary w-100">Sub Menu 1</a>
                <form action="{{ route('sub-one-menu.update',['sub_one_menu'=>$sub_one_menu->sub_one_menu_id]) }}" id="from" method="POST" enctype="multipart/form-data">
                    @csrf
                    {!! method_field('PUT') !!}
                    <input type="hidden" value="{{  $sub_one_menu->sub_one_menu_id }}" name="sub_one_menu_id">
                    <div class="form-group mb-3">
                        <label class="form-label" for="main_menu_id">Əsas Menu</label>
                        <select class="form-control @error('main_menu_id') is-invalid  @enderror" id="main_menu_id" name="main_menu_id">
                            @foreach($main_menus as $main_menu)
                                <option value="{{ $main_menu->main_menu_id }}" {{ old('main_menu_id',$sub_one_menu->main_menu_id)  == $main_menu->main_menu_id ? 'selected' : '' }}>{{ $main_menu->name_az }}</option>
                            @endforeach
                        </select>
                        @error('main_menu_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="name_az">Ad(AZ)</label>
                        <input type="text" class="form-control @error('name_az') is-invalid  @enderror" id="name_az" name="name_az" value="{{ old('name_az',$sub_one_menu->name_az) }}">
                        @error('name_az')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="name_en">Ad(EN)</label>
                        <input type="text" class="form-control @error('name_en') is-invalid  @enderror" id="name_en" name="name_en" value="{{ old('name_en',$sub_one_menu->name_en) }}">
                        @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="name_ru">Ad(RU)</label>
                        <input type="text" class="form-control @error('name_ru') is-invalid  @enderror" id="name_ru" name="name_ru" value="{{ old('name_ru',$sub_one_menu->name_ru) }}">
                        @error('name_ru')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="image">Şəkil</label>
                        <input type="file" class="form-control @error('image') is-invalid  @enderror" id="image" name="image" value="">
                        <p style="background-color: red;padding :10px; color:white;margin-top:10px">{{ $sub_one_menu->image }}</span>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary float-end" type="submit">Əlavə et</button>
                    </div>
                </form>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
