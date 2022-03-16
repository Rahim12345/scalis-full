@extends('back.layout.master')

@section('title') Blog @endsection

@section('css')

@endsection

@section('content')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-change').css('background', 'transparent url('+e.target.result +') top no-repeat');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <div class="page">
        @include('back.includes.menu')
        <div class="container-xl mt-3" style="min-height: 70vh">
            <div class="row row-cards">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="content p-3">
                            <form action="{{ route('back-blog.store') }}" id="contact-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    1780x665
                                    <span class="avatar avatar-xl mb-3 image-change cursor-pointer" id="image-change" onclick="$('#image').click()" style="display: block !important;width: 100% !important;height: 300px;background-image: url({{ asset('files/contact/'.\App\Helpers\Options::getOption('contact_image')) }});"><img id="change-image" src="{{ asset('back/images/add-image.png') }}" alt="Şəkili dəyiş" style="position: absolute;float: right;bottom: 0;right: 0;width: 30px;cursor: pointer"></span>
                                    <input type="file" name="image" id="image" onchange="readURL(this)" style="display: none">
                                    <div class="progress" style="display: none" id="imageProgress">
                                        <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                                    </div>
                                    @error('image')
                                    <small class="text-danger" id="image-error">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="title_az">Başlıq(AZ)</label>
                                    <input type="text" name="title_az" id="title_az" class="form-control w-100 @error('title_az') is-invalid  @enderror" value="{{ old('title_az') }}">
                                    @error('title_az')
                                    <small class="text-danger" id="title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="title_en">Başlıq(EN)</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control w-100 @error('title_en') is-invalid  @enderror" value="{{ old('title_en') }}">
                                    @error('title_en')
                                    <small class="text-danger" id="title_en-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="title_ru">Başlıq(RU)</label>
                                    <input type="text" name="title_ru" id="title_ru" class="form-control w-100 @error('title_ru') is-invalid  @enderror" value="{{ old('title_ru') }}">
                                    @error('title_ru')
                                    <small class="text-danger" id="title_ru-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="sub_title_az">Alt Başlıq(AZ)</label>
                                    <input type="text" name="sub_title_az" id="sub_title_az" class="form-control w-100 @error('sub_title_az') is-invalid  @enderror" value="{{ old('sub_title_az') }}">
                                    @error('sub_title_az')
                                    <small class="text-danger" id="sub_title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="sub_title_en">Alt Başlıq(EN)</label>
                                    <input type="text" name="sub_title_en" id="sub_title_en" class="form-control w-100 @error('sub_title_en') is-invalid  @enderror" value="{{ old('sub_title_en') }}">
                                    @error('sub_title_en')
                                    <small class="text-danger" id="sub_title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="sub_title_ru">Alt Başlıq(RU)</label>
                                    <input type="text" name="sub_title_ru" id="sub_title_ru" class="form-control w-100 @error('sub_title_ru') is-invalid  @enderror" value="{{ old('sub_title_ru') }}">
                                    @error('sub_title_ru')
                                    <small class="text-danger" id="sub_title_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="content_az">Məzmun(AZ)</label>
                                    <textarea name="content_az" id="content_az" class="form-control w-100 @error('content_az') is-invalid  @enderror" rows="10" placeholder="">{{ old('content_az') }}</textarea>
                                    @error('content_az')
                                    <small class="text-danger" id="content_az-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="content_en">Məzmun(EN)</label>
                                    <textarea name="content_en" id="content_en" class="form-control w-100 @error('content_en') is-invalid  @enderror" rows="10" placeholder="">{{ old('content_en') }}</textarea>
                                    @error('content_en')
                                    <small class="text-danger" id="content_en-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="content_ru">Məzmun(RU)</label>
                                    <textarea name="content_ru" id="content_ru" class="form-control w-100 @error('content_ru') is-invalid  @enderror" rows="10" placeholder="">{{ old('content_ru') }}</textarea>
                                    @error('content_ru')
                                    <small class="text-danger" id="content_ru-error">{{ $message }}</small>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace(content_az,{
                language: '{{ app()->getLocale() }}',
                filebrowserImageBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Images&_token={!! csrf_token() !!}',
                filebrowserBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Files',
                filebrowserUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Files&_token={!! csrf_token() !!}',
                toolbarGroups :[
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'insert' },
                    { name: 'forms' },
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools'}
                ],
            });

            CKEDITOR.replace(content_en,{
                language: '{{ app()->getLocale() }}',
                filebrowserImageBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Images&_token={!! csrf_token() !!}',
                filebrowserBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Files',
                filebrowserUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Files&_token={!! csrf_token() !!}',
                toolbarGroups :[
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'insert' },
                    { name: 'forms' },
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools'}
                ],
            });

            CKEDITOR.replace(content_ru,{
                language: '{{ app()->getLocale() }}',
                filebrowserImageBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Images&_token={!! csrf_token() !!}',
                filebrowserBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Files',
                filebrowserUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Files&_token={!! csrf_token() !!}',
                toolbarGroups :[
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'insert' },
                    { name: 'forms' },
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools'}
                ],
            });
        });
    </script>
@endsection
