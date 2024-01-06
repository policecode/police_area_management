@extends('layouts.backend')
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<form action="{{route('admin.tourists.update', $item->id)}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Họ tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Họ tên..." value="{{old('name') ??$item->name}}">
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
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{old('slug') ??  $item->slug}}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Ngày, tháng, năm sinh </label>
                <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{old('birthday') ?? dateFormat($item->birthday, 'Y-m-d')}}">
                @error('birthday')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Giới tính</label>
                @include('parts.template.select', [
                    'title_option' => 'Chọn giới tính',
                    'name' => 'gender',
                    'list_option' => $gender,
                    'value_current' => $item->gender
                ])
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Quốc tịch</label>
                @include('parts.template.select2', [
                    'id' => 'js-example-basic-single',
                    'title_option' => 'Chọn quốc tịch',
                    'name' => 'country',
                    'list_option' => $country,
                    'value_current' => $item->country
                ])
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Số hộ chiếu</label>
                <input type="text" name="passport" class="form-control @error('passport') is-invalid @enderror" placeholder="Hộ chiếu..." value="{{old('passport') ?? $item->passport}}">
                @error('passport')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
  
        <div class="col-12">
            <div class="mb-3">
                <label for="">Ghi chú</label>
                <textarea name="note" class="ckeditor form-control @error('note') is-invalid @enderror" placeholder="Ghi chú..." id="" cols="30" rows="4">{{old('note') ?? $item->note}}</textarea>
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
        <a href="{{route('admin.tourists.index')}}" class="btn btn-danger">Hủy</a>
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