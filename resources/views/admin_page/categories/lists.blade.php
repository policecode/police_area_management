<?php


?>
@extends('layouts.backend')
@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm mới</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý người dùng</h6>
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
                            <th>Slug</th>
                            <th>Xem</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Slug</th>
                            <th>Xem</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($records->toArray() as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['slug'] }}</td>
                                <td><a target="_blank" href="{{'/danh-muc/'.$item['slug']}}" class="btn btn-primary">Xem</a></td>
                                <td>{{ dateFormat($item['created_at']) }}</td>
                                <td><a href="{{route('admin.categories.edit', $item['id'])}}" class="btn btn-warning">Sửa</a></td>
                                <td><a href="{{route('admin.categories.destroy', $item['id'])}}" data-name="{{$item['name']}}" class="btn btn-danger delete__action">Xóa</a></td>
                            </tr>
                            @if (count($item['sub_category']) > 0)
                            @foreach ($item['sub_category'] as $child)
                                <tr>
                                    <td>---- {{ $child['name'] }}</td>
                                    <td>{{ $child['slug'] }}</td>
                                <td><a target="_blank" href="{{'/danh-muc/'.$child['slug']}}" class="btn btn-primary">Xem</a></td>
                                    <td>{{ dateFormat($child['created_at']) }}</td>
                                    <td><a href="{{route('admin.categories.edit', $child['id'])}}" class="btn btn-warning">Sửa</a></td>
                                    <td><a href="{{route('admin.categories.destroy', $child['id'])}}" data-name="{{$child['name']}}" class="btn btn-danger delete__action">Xóa</a></td>
                                </tr>
                                
                            @endforeach
                            @endif
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
