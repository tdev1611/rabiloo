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
                            <form action="" method="POST" id="actionForm">
                                @csrf
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
                                                    <th>Điện thoại</th>
                                                    <th>Sinh nhật</th>
                                                    <th>Phim đã đặt</th>
                                                    <th>Trạng thái</th>
                                                    {{-- <th>Action</th> --}}
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
                                                        <td><span>{{ $user->name }}</span></td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->date_of_birth }}
                                                        </td>

                                                        <td>
                                                            @foreach ($user->booking as $item)
                                                                <p style="margin-bottom: 0"> {{ $item->movie->name }}</p>
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                            {{ $user->is_active }}
                                                        </td>

                                                        {{-- <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="margin-right:6px" class="badge bg-primary ">
                                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                        style="color:#fff">Sửa</a>
                                                                </span>

                                                                <span class="badge bg-danger delete_user">
                                                                    <a href="#" style="color: #fff">Xóa</a>
                                                                </span>
                                                            </div>
                                                        </td> --}}
                                                    </tr>
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


        {{-- delte --}}
        <script></script>
    @endsection
