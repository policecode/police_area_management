@extends('layouts.backend')
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<form action="{{route('admin.businesses.update', $item->id)}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên cơ sở kinh doanh</label>
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
                <label for="">Địa chỉ kinh doanh </label>
                <input type="text" name="address" class="form-control @error('exp') is-invalid @enderror" placeholder="Địa chỉ trụ sở..." value="{{old('address') ?? $item->address}}">
                @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Loại hình kinh doanh</label>
                @include('parts.template.select', [
                    'title_option' => 'Chọn loại hình',
                    'name' => 'type',
                    'list_option' => $type,
                    'value_current' => $item->type
                ])
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Doanh nghiệp pháp lý</label>
                @include('parts.template.select2', [
                    'id' => 'js-example-basic-single',
                    'title_option' => 'Chọn doanh nghiệp',
                    'name' => 'emterprises_id',
                    'list_option' => $emterprises,
                    'value_current' => $item->emterprises_id
                ])
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="">Thông tin người quản lý</label>
                <textarea name="manager" class="ckeditor form-control @error('manager') is-invalid @enderror" placeholder="Thông tin người quản lý..." id="" cols="30" rows="4">{{old('manager') ?? $item->manager}}</textarea>
                @error('manager')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="">Ghi chú về doanh nghiệp</label>
                <textarea name="note" class="ckeditor form-control @error('note') is-invalid @enderror" placeholder="Ghi chú..." id="" cols="30" rows="4">{{old('note') ?? $item->note}}</textarea>
                @error('note')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.businesses.index')}}" class="btn btn-danger">Hủy</a>
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