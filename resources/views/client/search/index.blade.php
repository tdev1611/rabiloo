@extends('client.layout')
@section('title', 'Tìm kiếm bài viết ')
@section('content')
    <div class="row">

        <h4>
            Bài viết được tìm kiếm 
        </h4>

        @foreach ($posts as $post)
            <div class="col-md-6 col-lg-3">
                <x-client.get-posts :post="$post" />
            </div>
        @endforeach


    </div>
    <div>
        {{ $posts->links() }}
    </div>
@endsection
