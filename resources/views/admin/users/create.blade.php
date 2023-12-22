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
                        User </h1>
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
                        <li class="breadcrumb-item text-muted"> Add User </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
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
                        {{-- content --}}
                        <form method="POST" id="form_add_user" action="{{ route('admin.users.store') }}">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label"> name </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="name " value="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label"> email </label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="email " value="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label"> password </label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="password " value="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role_id" class="form-label"> Roles </label>
                                    <select class="form-select" multiple aria-label="multiple select example"
                                        name="role_id[]">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                            <div class="input-group mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
        $('#form_add_user').submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            .then((result) => {
                                location.reload();
                            })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 5000
                        }).then((result) => {

                        })
                    }

                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 5000
                    }).then((result) => {

                    })
                }
            });
        })
    </script>

    <x-admin.create-slug />
@endsection
