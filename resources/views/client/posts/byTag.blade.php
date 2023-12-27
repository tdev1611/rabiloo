@extends('client.layout')
@section('title', 'Bài viết của Tag', $tag->title)
@section('content')
    <div class="row">

        <h4>
            <span class="text-muted">
                Bài viết  theo Tag :</span> {{ $tag->title }}
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
