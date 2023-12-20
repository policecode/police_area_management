@extends('layouts.backend')
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<form action="{{route('admin.teachers.update', $item->id)}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
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
                <label for="">Số năm kinh nghiệm</label>
                <input type="text" name="exp" class="form-control @error('exp') is-invalid @enderror" placeholder="Số năm kinh nghiệm..." value="{{old('exp') ?? $item->exp}}">
                @error('exp')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Ảnh đại diện</label>
                <div class="row">
                    <div class="col-6">
                        <input id="thumbnail" type="text" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{old('image') ?? $item->image}}">
                    </div>
                    <div class="col-3">
                        <button id="lfm"  data-input="thumbnail" data-preview="holder" type="button" class="btn btn-primary">Chọn Ảnh</button>
                    </div>
                    <div id="holder" class="col-3 custom__thumbnail">
                        @if (old('image') ?? $item->image)
                            <img src="{{old('image') ?? $item->image}}" alt="">
                        @endif
                    </div>
                </div>
                @error('image')
                    <div class="invalid-feedback" style="display: block;">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="">Thông tin về giáo viên</label>
                <textarea name="description" class="ckeditor form-control @error('description') is-invalid @enderror" placeholder="Thông tin về giáo viên..." id="" cols="30" rows="4">{{old('description') ?? $item->description}}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.teachers.index')}}" class="btn btn-danger">Hủy</a>
        @csrf
        @method('PUT')
    </div>
</form>
@endsection

@section('scripts')
<script>
    ChangeToSlug('input[name="name"]', 'input[name="slug"]');
    lfm('lfm', 'image', {});
</script>
@endsection

<style>
    .custom__thumbnail img {
        width: 100%
    }
    </style>