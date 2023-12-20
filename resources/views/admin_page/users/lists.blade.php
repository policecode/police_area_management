<?php

?>
@extends('layouts.backend')
@section('content')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm mới</a>
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
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Thời gian</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($records as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->group_id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td><a href="{{route('admin.users.edit', $item)}}" class="btn btn-warning">Sửa</a></td>
                                <td><a href="{{route('admin.users.delete', $item)}}" data-name="{{$item->name}}" class="btn btn-danger delete__action">Xóa</a></td>
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
