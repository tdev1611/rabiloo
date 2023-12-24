@extends('client.layout')
@section('title', 'Home')
@section('content')
    <div class="row">

        @foreach ($posts as $post)
            <div class="col-md-6 col-lg-3">
                <div class="item">
                    <img class="img-fluid"
                        src="https://images.pexels.com/photos/10835697/pexels-photo-10835697.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                    {{-- <div id="detail">
                        <a href="{{ route('client.posts.show', $post->slug) }}" class="btn btn-secondary">Detail</a>
                    </div> --}}

                    <div id="name-post">
                        <a href="{{ route('client.posts.show', $post->slug) }}" class="btn btn-secondary mt-3">
                            <span class="mt-3">{{ $post->title }}</span> <br>
                        </a>

                    </div>

                </div>
            </div>
        @endforeach


    </div>
@endsection
