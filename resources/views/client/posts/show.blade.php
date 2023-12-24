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

        <div class="col-md-4">
            <div class="item">
                <img class="img-fluid"
                src="https://images.pexels.com/photos/10835697/pexels-photo-10835697.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="">
            </div>

            <div class="text-center">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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

        <div class="mb-3 col-md-6">
            <label for="content" class="form-label"> Bình luận</label>
            <textarea name="content" id="content" cols="30" rows="5" placeholder="Bình luận" class="form-control"></textarea>
        </div>
    </div>

    <!-- Modal -->
  
@endsection



@section('js')

    {{-- change --}}

    <script>
        $(document).ready(function() {
            $('.qty').change(function() {
                let qty = $(this).val();
                let data_id = $(this).attr('data-id');
                let ticketPrice = $('#ticket_price-' + data_id).val();
                let newTotal = qty * ticketPrice;
                $('.ct-total .total-' + data_id).text(newTotal);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(".booking_form").submit(function(e) {
                event.preventDefault();
                let formId = $(this).closest('form').data('id');

                let qty = $('#qty-' + formId).val();
                let slot = $('#slot-' + formId).val();
                let theater_id = $('#theater_id-' + formId).val();
                let post_id = $('#post_id-' + formId).val();
                let ticket_price = $('#ticket_price-' + formId).val();


                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: {
                        theater_id: theater_id,
                        post_id: post_id,
                        slot: slot,
                        ticket_price: ticket_price,
                        qty: qty,
                        data_id : formId,
                        
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 3500,
                            }).then((result) => {});
                        }
                    },
                });
            });
        });
    </script>
@endsection
