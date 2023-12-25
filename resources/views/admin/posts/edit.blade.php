@extends('admin.layout')
@section('content')
    <x-admin.tiny-edit />
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Post </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"> Edit Post</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                @role('admin')
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back</a>
                @endrole
            </div>
            <!--end::Toolbar container-->
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        {{-- content --}}
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <form method="POST" id="formsize" action="{{ route('admin.posts.update', $post->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-5">
                                    <label for="title" class="form-label"> Name </label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="title " value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="slug" class="form-label"> Slug </label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="slug " value="{{ old('slug', $post->slug) }}">
                                    @error('slug')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-10">
                                <label for="desc" class="form-label"> Nội dung</label>
                                <textarea name="desc" id="desc" cols="30" rows="10" placeholder="desc" class="form-control">{{ old('desc', $post->desc) }}</textarea>
                                @error('desc')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="category_id" class="form-label"> category </label>
                                    <select class="form-select" name="category_id" id="category_id">
                                        <option value="">Chọn danh mục</option>

                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $post->category_id ? 'selected' : '' }}
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="image" class="form-label"> Ảnh </label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                    <img height="100px" width="100px" src="{{ asset($post->image) }}"
                                        alt="{{ $post->image }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="published_at" class="form-label"> Thời gian hẹn đăng bài </label>
                                    <input type="datetime-local" id="published_at" name="published_at" class="form-control"
                                        value="{{ old('published_at', $post->published_at) }}">
                                    @error('published_at')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>


                            <div class="input-group mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection

@section('js')
    <x-admin.create-slug />
@endsection
