<?php


?>
@extends('layouts.backend')
@section('content')
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Thêm mới</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý khóa học</h6>
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
                            <th>Giá</th>
                            <th>Khuyến mãi</th>
                            <th>Bài giảng</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Slug</th>
                            <th>Giá</th>
                            <th>Khuyến mãi</th>
                            <th>Bài giảng</th>
                            <th>Trạng thái</th>
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
                                <td>{{ currency_format($item['price'], ' đ') }}</td>
                                <td>{{ currency_format($item['sale_price'], ' đ') }}</td>
                                <td><a class="btn btn-primary">Bài giảng</a></td>
                                <td>
                                    @if ($item['status'])
                                        <button class="btn btn-success">Đã ra mắt</button>
                                    @else
                                        <button class="btn btn-dark">Chưa ra mắt</button>
                                    @endif
                                </td>
                                <td>{{ dateFormat($item['created_at'], 'd/m/Y') }}</td>
                                
                                <td><a href="{{route('admin.courses.edit', $item['id'])}}" class="btn btn-warning">Sửa</a></td>
                                <td><a href="{{route('admin.courses.destroy', $item['id'])}}" data-name="{{$item['name']}}" class="btn btn-danger delete__action">Xóa</a></td>
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
