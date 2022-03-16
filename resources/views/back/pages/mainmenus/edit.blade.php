@extends('back.layout.master')

@section('title')  @endsection
@section('css')

@endsection

@section('content')
    <div class="page">
        @include('back.includes.menu')

        <div class="content">
            <div class="mb-3 col-md-8 offset-md-2">
                <a href="{{ route('esas-menu.index') }}" class="btn btn-primary w-100">Əsas Menular</a>
                <form action="{{ route('esas-menu.update',['esas_menu'=>$main_menu->main_menu_id]) }}" id="from" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="main_menu_id" value="{{ $main_menu->main_menu_id }}">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label" for="name_az">Ad(AZ)</label>
                        <input type="text" class="form-control @error('name_az') is-invalid  @enderror" id="name_az" name="name_az" value="{{ old('name_az',$main_menu->name_az) }}">
                        @error('name_az')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="name_en">Ad(EN)</label>
                        <input type="text" class="form-control @error('name_en') is-invalid  @enderror" id="name_en" name="name_en" value="{{ old('name_en',$main_menu->name_en) }}">
                        @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="name_ru">Ad(RU)</label>
                        <input type="text" class="form-control @error('name_ru') is-invalid  @enderror" id="name_ru" name="name_ru" value="{{ old('name_ru',$main_menu->name_ru) }}">
                        @error('name_ru')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="description_az">Təsvir(AZ)</label>
                        <textarea class="form-control @error('description_az') is-invalid  @enderror" id="description_az" name="description_az">{{ old('description_az',$main_menu->description_az) }}</textarea>
                        @error('description_az')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="description_en">Təsvir(EN)</label>
                        <textarea class="form-control @error('description_en') is-invalid  @enderror" id="description_en" name="description_en">{{ old('description_en',$main_menu->description_en) }}</textarea>
                        @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="description_ru">Təsvir(RU)</label>
                        <textarea class="form-control @error('description_ru') is-invalid  @enderror" id="description_ru" name="description_ru">{{ old('description_ru',$main_menu->description_ru) }}</textarea>
                        @error('description_ru')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="image">Şəkil</label>
                        <input type="file" class="form-control @error('image') is-invalid  @enderror" id="image" name="image" value="">
                        <p style="background-color: red;padding :10px; color:white;margin-top:10px">{{ $main_menu->image }}</span>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary float-end" type="submit">Redaktə et</button>
                    </div>
                </form>
            </div>
        </div>
        @include('back.includes.footer')
    </div>
@endsection

@section('js')

@endsection
