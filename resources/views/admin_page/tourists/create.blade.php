@extends('layouts.backend')
@section('content')
<form action="{{route('admin.tourists.store')}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Họ tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên cơ sở kinh doanh..." value="{{old('name')}}">
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
                <label for="">Ngày, tháng, năm sinh</label>
                <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{old('birthday')}}">
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
                    'value_current' => ''
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
                    'value_current' => ''
                ])
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="">Thông tin người quản lý</label>
                <textarea name="manager" class="ckeditor form-control @error('manager') is-invalid @enderror" placeholder="Thông tin người quản lý..." id="" cols="30" rows="4">{{old('manager')}}</textarea>
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
                <textarea name="note" class="ckeditor form-control @error('note') is-invalid @enderror" placeholder="Ghi chú..." id="" cols="30" rows="4">{{old('note')}}</textarea>
                @error('note')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            
        </div>
  
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.tourists.index')}}" class="btn btn-danger">Hủy</a>
        @csrf
        @method('POST')
    </div>
</form>

@endsection

@section('scripts')
<script>
    ChangeToSlug('input[name="name"]', 'input[name="slug"]');


</script>
@endsection

<style>
    .custom__thumbnail img {
        width: 100%
    }
    </style>