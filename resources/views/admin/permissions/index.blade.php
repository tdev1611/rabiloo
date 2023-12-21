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
                        Roles</h1>
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
                                    <h4 class="card-title">List roles </h4>
                                    <div class="table-responsive">
                                        <table id="myTable"
                                            class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Desc</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                    $temp = 1;
                                                @endphp
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td>{{ $temp++ }}</td>
                                                        <td>
                                                            {{ $role->name }}
                                                        </td>
                                                        <td>{{ $role->guard_name }}</td>
                                                        <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="" class="badge bg-primary ">
                                                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                        style="color:#fff">Sửa</a>
                                                                </span>
                                                                <span class="badge bg-danger delete_role">
                                                                    <a href="{{ route('admin.roles.delete', $role->id) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop-{{ $role->id }}"
                                                                        style="color:#fff">Xóa </a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->

                                                    <div class="modal fade" id="staticBackdrop-{{ $role->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Delete
                                                                        role
                                                                        <b>{{ $role->title }}</b>
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
                                                                    <a href="{{ route('admin.roles.delete', $role->id) }}"
                                                                        type="button" class="btn btn-danger">Yes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <x.admin.role-modal :role="$role"
                                                        :deleteRoute="{{ route('admin.categories.delete', $role->id) }}"
                                                        :modelType="'role'" /> --}}
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
