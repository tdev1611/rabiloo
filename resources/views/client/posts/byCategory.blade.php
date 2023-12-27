@extends('client.layout')
@section('title', 'Bài viết của danh mục', $category->title)
@section('content')
    <div class="row">

        <h4>
            <span class="text-muted">
                Bài viết được theo danh mục :</span> {{ $category->title }}
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
