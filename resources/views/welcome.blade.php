@extends('client.layout')
@section('title', 'Home')
@section('content')
    <div class="row">
        <h3>Trang chu</h3>
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
