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
                        Screenings </h1>
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
                        <li class="breadcrumb-item text-muted"> Add Screenings </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-primary">Back</a>
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
                        <form method="POST" id="form_add_screenings" action="{{ route('admin.screenings.store') }}">
                            <div class="row">
                                <div class="mb-3 col-md-10">
                                    <label for="name" class="form-label"> Name Screenings </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="name " value="{{ old('name') }}">
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="slot" class="form-label"> slot </label>
                                    <input type="number" class="form-control" name="slot" id="slot"
                                        placeholder="slot " min="1" max="255" value="1">
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="booked" class="form-label"> booked </label>
                                    <input type="number" class="form-control" name="booked" id="booked"
                                        placeholder="booked " min="0" max="255" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-5">
                                    <label for="movie_id" class="form-label"> Movies </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="movie_id" id="movie_id">
                                        <option value="">
                                            Choose a Movie
                                        </option>

                                        @isset($movies)
                                            @foreach ($movies as $movie)
                                                <option value="{{ $movie->id }}">
                                                    {{ $movie->name }}
                                                </option>
                                            @endforeach
                                        @endisset

                                    </select>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="theater_id" class="form-label"> Theaters </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="theater_id" id="theater_id">
                                        <option value="">
                                            Choose a Theater
                                        </option>
                                        @isset($theaters)
                                            @foreach ($theaters as $theater)
                                                <option value="{{ $theater->id }}">
                                                    {{ $theater->name }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-10">
                                    <label for="status" class="form-label">Trạng thái </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="status" id="status">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                                            Hiển thị
                                        </option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}> Ẩn
                                        </option>
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
        $('#form_add_screenings').submit(function(e) {
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
                            timer: 2000
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
                        timer: 2000
                    }).then((result) => {

                    })
                }
            });
        })
    </script>
@endsection
