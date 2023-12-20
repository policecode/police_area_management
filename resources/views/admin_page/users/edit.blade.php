@extends('layouts.backend')
@section('content')
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<form action="{{route('admin.users.update', $item->id)}}" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{$item->name}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{$item->email}}">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Nhóm</label>
                <select name="group_id" id="" class="form-control @error('group_id') is-invalid @enderror">
                    <option value="">Chọn nhóm</option>
                    <option value="1" {{$item->group_id == 1 ? 'selected':''}}>admin</option>
                </select>
                @error('group_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu..." value="">
                @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        @csrf
        @method('PUT')
    </div>

</form>
@endsection