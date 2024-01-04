<?php


?>
@extends('layouts.backend')
@section('content')
    <a href="{{ route('admin.businesses.create') }}" class="btn btn-primary">Thêm mới</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$page_title}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Loại hình</th>
                            <th>Địa chỉ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Loại hình</th>
                            <th>Địa chỉ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($records->toArray() as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['type_display'] }}</td>
                                <td>{{ $item['address'] }}</td>
                                <td><a href="{{route('admin.businesses.edit', $item['id'])}}" class="btn btn-warning">Sửa</a></td>
                                <td><a href="{{route('admin.businesses.destroy', $item['id'])}}" data-name="{{$item['name']}}" class="btn btn-danger delete__action">Xóa</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        
        @include('parts.template.paging')
        @include('parts.backend.formDelete')
    </div>
@endsection

@section('scripts')
@endsection
