@extends('admin.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Categories</h1>
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
                        <li class="breadcrumb-item text-muted">Danh sách</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    {{-- alert --}}


                </div>
            </div>
            <!--end::Toolbar container-->
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="" method="POST" id="actionForm">
                                @csrf
                                <div class="card-body">
                                    {{-- <div class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropAction">
                                            Thực hiện
                                        </button>
                                    </div> --}}
                                    <h4 class="card-title">List categorys </h4>
                                    <div class="table-responsive">
                                        <table id="myTable"
                                            class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th>Create_at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                    $temp = 1;
                                                @endphp
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $temp++ }}</td>
                                                        <td>
                                                            {{ $category->title }}
                                                        </td>
                                                        <td>{{ $category->slug }}</td>
                                                        <td>
                                                            {!! $category->status !!}
                                                        </td>
                                                        <td>{{ $category->created_at }}</td>
                                                        <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="" class="badge bg-primary ">
                                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                                        style="color:#fff">Sửa</a>
                                                                </span>
                                                                <span class="badge bg-danger delete_category">
                                                                    <a href="{{ route('admin.categories.delete', $category->id) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop-{{ $category->id }}"
                                                                        style="color:#fff">Xóa </a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->

                                                    <div class="modal fade" id="staticBackdrop-{{ $category->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Delete
                                                                        Category
                                                                        <b>{{ $category->title }}</b>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-toggle="modal" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are U sure?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">No</button>
                                                                    <a href="{{ route('admin.categories.delete', $category->id) }}"
                                                                        type="button" class="btn btn-danger">Yes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <x.admin.category-modal :category="$category"
                                                        :deleteRoute="{{ route('admin.categories.delete', $category->id) }}"
                                                        :modelType="'Category'" /> --}}
                                                @endforeach




                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // order: [
                    //     [0, 'desc']
                    // ],

                });
            });
        </script>
    @endsection
