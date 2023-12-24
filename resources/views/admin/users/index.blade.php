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
                        Thành viên</h1>
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
                            <form action="" method="user" id="actionForm">
                                @csrf
                                <div style=" margin: 030px 0 0 30px;">

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary  my-3">
                                        Active
                                    </a>
                                    <a href="{{ request()->fullUrlwithQuery(['status' => 'disabled']) }}"
                                        class="btn btn-danger my-3">
                                        Trash <i class="fas fa-trash"></i>
                                        <span>()</span>
                                    </a>
                                </div>

                                <!-- Modal -->
                                {{-- <div class="modal fade" id="staticBackdropAction" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="staticBackdropLabel">Modal title
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="myselect">
                                                            Trạng thái thành viên
                                                        </label>
                                                        <select class="form-control mr-1 " name="status" id="status">
                                                            <option value="">Chọn</option>
                                                            <option value="1"> Hoạt động
                                                            </option>
                                                            <option value="2"> Vô hiệu hóa
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top:20px">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" name="delete_users"
                                                            id="delete_users">
                                                        <label class="form-check-label" for="delete_users">
                                                            Xóa thành viên
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Thực hiện</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="card-body">
                                    {{-- <div class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropAction">
                                            Thực hiện
                                        </button>
                                    </div> --}}
                                    <h4 class="card-title">Danh sách thành viên</h4>
                                    <div class="table-responsive">
                                        <table id="myTable"
                                            class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    {{-- <th scope="col">
                                                        <input type="checkbox" name="check_all" id="">
                                                    </th> --}}
                                                    <th>#</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Vai trò</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        {{-- <th scope="col">
                                                            <input type="checkbox" name="list_check[]"
                                                                value="{{ $user->id }}">
                                                        </th> --}}
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if ($user->roles == 'user')
                                                                {{ $user->roles }}
                                                            @else
                                                                @foreach ($user->roles as $role)
                                                                    <span>
                                                                        {{ $role->name }}
                                                                    </span>
                                                                @endforeach
                                                            @endif
                                                        </td>

                                                        @if (request()->status !== 'disabled')
                                                            <td class="">
                                                                <div class="d-flex" style=" justify-content: space-around;">
                                                                    <span style="" class="badge bg-primary ">
                                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                            style="color:#fff">Sửa</a>
                                                                    </span>
                                                                    <span class="badge bg-danger delete_user">
                                                                        <a href="{{ route('admin.users.delete', $user->id) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#staticBackdrop-{{ $user->id }}"
                                                                            style="color:#fff">Xóa </a>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td class="">
                                                                <div class="d-flex" style=" justify-content: space-around;">
                                                                    <span style="" class="badge bg-success ">
                                                                        <a href="{{ route('admin.users.restore', $user->id) }}"
                                                                            style="color:#fff">Restore</a>
                                                                    </span>
                                                                    <span class="badge bg-dark delete_user">
                                                                        <a href="{{ route('admin.users.delete', $user->id) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#staticBackdrop-{{ $user->id }}"
                                                                            style="color:#fff">forceDelete </a>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>


                                                    <div class="modal fade" id="staticBackdrop-{{ $user->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Delete
                                                                        Category
                                                                        <b>{{ $user->email }}</b>
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
                                                                       @if (request()->status !== 'disabled')
                                                                        <a href="{{ route('admin.users.delete', $user->id) }}"
                                                                            type="button" class="btn btn-danger">Yes</a>
                                                                    @else
                                                                        <a href="{{ route('admin.users.forceDelete', $user->id) }}"
                                                                            type="button" class="btn btn-danger">Yes</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
