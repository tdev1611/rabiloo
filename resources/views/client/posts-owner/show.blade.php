@extends('client.layout')
@section('title', 'Chi tiết bài viết')
@section('content')
    <style>
        .text-bold {
            font-weight: bold;
        }
    </style>
    {{-- <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}</li>
        </ol>
    </nav> --}}
    <div class="row">
        <h3>
            Chi tiết bài  viết của bạn
        </h3>
        <div class="col-md-4">
            <div class="item">
                <img class="img-fluid"
                    src="https://images.pexels.com/photos/10835697/pexels-photo-10835697.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="">
            </div>

            <div class="text-center">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" id="btn_like" data-id="{{ $post->id }}">
                    Like
                </button>

            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="post_name">
                <span>
                    <h3> {{ $post->title }}</h3>
                </span>
            </div>


            <div class="post_desc mt-3">
                <p class="text-bold">
                    Nội dung :
                </p>
                <span> {!! $post->desc !!} </span>

            </div>
        </div>

        <form id="form_comment" action="{{ route('client.comments.store', $post) }}" method="post">
            @csrf
            <div class="mb-3 col-md-6">
                <label for="content" class="form-label"> Bình luận</label>
                <textarea name="content" id="content" cols="30" rows="5" placeholder="Bình luận" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Bình luận
            </button>
        </form>

        <div class="mt-4 " style="border-top:1px solid tan">
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="card-title">Nhận xét</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($post->comments as $comment)
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                    <p>
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                        @endforeach


                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal -->

@endsection



@section('js')




    <script>
        // {{-- like --}} 

        $(document).ready(function() {
            $('#btn_like').click(function() {
                let post_id = $(this).attr('data-id');
                console.log(post_id);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('client.likes.store', ['post' => $post->id]) }}",
              
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

        })

        // {{-- commnet --}}
        $('#form_comment').submit(function(e) {
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
@endsection
