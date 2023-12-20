@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    @if (session('msg-error'))
        <div class="alert alert-danger">{{ session('msg-error') }}</div>
    @endif
    <form action="{{ route('admin.courses.update', $item->id) }}" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Tên..." value="{{ old('name') ?? $item->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                        placeholder="Slug..." value="{{ old('slug') ?? $item->slug }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id="" class="form-control @error('teacher_id') is-invalid @enderror">
                        <option value="0">Chọn Giảng Viên</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}" {{((old('teacher_id') ?? $item->teacher_id) == $teacher->id)?'selected':''}}>{{$teacher->name}}</option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã khóa học</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                        placeholder="Mã khóa học..." value="{{ old('code') ?? $item->code }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khóa học</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                        placeholder="Giá khóa học..." value="{{ old('price') ?? $item->price }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror"
                        placeholder="Giá khuyến mãi..." value="{{ old('sale_price') ?? $item->sale_price }}">
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id=""
                        class="form-control @error('is_document') is-invalid @enderror">
                        <option value="0" {{ ((old('is_document') ?? $item->is_document) == 0)? 'selected':'' }}>Không</option>
                        <option value="1" {{ ((old('is_document') ?? $item->is_document) == 1)? 'selected':'' }}>Có</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Trạng thái</label>
                    <select name="status" id="" class="form-control @error('status') is-invalid @enderror">
                        <option value="0" {{ ((old('status') ?? $item->status) == 0)? 'selected':'' }}>Chưa ra mắt</option>
                        <option value="1" {{ ((old('status') ?? $item->status) == 1)? 'selected':'' }}>Đã ra mắt</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Ảnh đại diện</label>
                    <div class="row">
                        <div class="col-6">
                            <input id="thumbnail" type="text" name="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Ảnh đại diện..."
                                value="{{ old('thumbnail') ?? $item->thumbnail }}">
                        </div>
                        <div class="col-3">
                            <button id="lfm" data-input="thumbnail" data-preview="holder" type="button"
                                class="btn btn-primary">Chọn Ảnh</button>
                        </div>
                        <div id="holder" class="col-3 custom__thumbnail">
                            @if (old('thumbnail') ?? $item->thumbnail)
                                <img src="{{ old('thumbnail') ?? $item->thumbnail }}" alt="">
                            @endif
                        </div>
                    </div>
                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="supports" class="form-control @error('supports') is-invalid @enderror" placeholder="Hỗ trợ..."
                        id="" cols="30" rows="4">{{ old('supports') ?? $item->supports }}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="col-12">
                <div class="mb-3">
                    <h5>Chuyên mục</h5>
                    {!!renderCheckboxCategories($categories, old('categories')??$item->catIds)!!}
                    @error('categories')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" class="ckeditor form-control @error('detail') is-invalid @enderror"
                        placeholder="Nội dung..." id="" cols="30" rows="4">{{ old('detail') ?? $item->detail }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Hủy</a>
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