@extends('layouts.backend')
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<form action="{{route('admin.companies.update', $item->id)}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên doanh nghiệp</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{old('name') ??$item->name}}">
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
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug') ?? $item->slug}}">
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
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Mã doanh nghiệp..." value="{{old('code') ?? $item->code}}">
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
                <input type="text" name="boss" class="form-control @error('boss') is-invalid @enderror" placeholder="Chủ doanh nghiệp..." value="{{old('boss') ?? $item->boss}}">
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
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Chủ doanh nghiệp..." value="{{old('address') ?? $item->address}}">
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
                <textarea name="note" class="ckeditor form-control @error('note') is-invalid @enderror" placeholder="Thông tin về giáo viên..." id="" cols="30" rows="4">{{old('note') ?? $item->note}}</textarea>
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
                <div id="form__input_image" data-image="{{old('album') ? json_encode(old('album')) : $item->album}}">
                </div>
                @error('album')
                    <div class="invalid-feedback" style="display: block;">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.companies.index')}}" class="btn btn-danger">Hủy</a>
        @csrf
        @method('PUT')
    </div>
</form>
@endsection

@section('scripts')
<script>
    ChangeToSlug('input[name="name"]', 'input[name="slug"]');
    showBoxImage('#form__input_image', 'album');
</script>
@endsection

<style>
    .custom__thumbnail img {
        width: 100%
    }
    </style>