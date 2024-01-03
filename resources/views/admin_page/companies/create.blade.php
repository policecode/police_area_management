@extends('layouts.backend')
@section('content')
<form action="{{route('admin.companies.store')}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên doanh nghiệp</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên doanh nghiệp..." value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug')}}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Mã doanh nghiệp</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Mã doanh nghiệp..." value="{{old('code')}}">
                @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Chủ doanh nghiệp</label>
                <input type="text" name="boss" class="form-control @error('exp') is-invalid @enderror" placeholder="Chủ doanh nghiệp..." value="{{old('boss')}}">
                @error('boss')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Địa chỉ trụ sở chính</label>
                <input type="text" name="address" class="form-control @error('exp') is-invalid @enderror" placeholder="Địa chỉ trụ sở..." value="{{old('address')}}">
                @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="">Ghi chú về doanh nghiệp</label>
                <textarea name="note" class="ckeditor form-control @error('note') is-invalid @enderror" placeholder="Ghi chú..." id="" cols="30" rows="4">{{old('note')}}</textarea>
                @error('note')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="">Hình ảnh liên quan</label>
                <div id="form__input_image" data-image="{{json_encode(old('album')) }}">
                   
                </div>
                
                @error('album')
                    <div class="invalid-feedback" style="display: block;">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.companies.index')}}" class="btn btn-danger">Hủy</a>
        @csrf
        @method('POST')
    </div>
</form>

@endsection

@section('scripts')
<script>
    ChangeToSlug('input[name="name"]', 'input[name="slug"]');
    showBoxImage('#form__input_image', 'album');
    // addInputImage('#add_input_image', '#form__input_image','album');

</script>
@endsection

<style>
    .custom__thumbnail img {
        width: 100%
    }
    </style>