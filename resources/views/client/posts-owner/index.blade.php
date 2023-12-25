@extends('client.layout')
@section('title', 'Danh sách bài viết của bạn')
@section('content')

    <div class="lg-12 py-3 container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="" method="POST" id="actionForm">
                            @csrf
                            <div style=" margin: 030px 0 0 30px;">

                                <a href="{{ route('client.postsOwner.index') }}" class="btn btn-primary  my-3">
                                    Active
                                </a>
                                <a href="{{ request()->fullUrlwithQuery(['status' => 'disabled']) }}"
                                    class="btn btn-danger my-3">
                                    Trash <i class="fas fa-trash"></i>
                                    <span>()</span>
                                </a>
                            </div>
                            <div class="card-body">
                                {{-- <div class="text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropAction">
                                    Thực hiện
                                </button>
                            </div> --}}
                                <h4 class="card-title">List posts </h4>
                                <div class="table-responsive">
                                    <table id="myTable"
                                        class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                <th>#</th>
                                                <th>Tiều đề</th>
                                                <th>Category</th>
                                                <th>Writer</th>
                                                <th>Image</th>
                                                <th>Thời gian hen đăng bài</th>
                                                <th>Create_at</th>
                                                <th>Trạng thái</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{ $post->id }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">
                                                            <a target="_blank" style="text-decoration: none;  color: white;"
                                                                href="{{ route('client.postsOwner.show', $post->slug) }}"
                                                                title="  {{ $post->title }}">
                                                                {{ $post->title }}</a>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $post->category->title }}
                                                    </td>
                                                    <td>
                                                        {{ $post->user->name }}
                                                    </td>
                                                    <td>
                                                        <img height="100" src="{{ asset($post->image) }}"
                                                            alt="{{ $post->title }}">
                                                    </td>
                                                    <td>{{ $post->published_at }}</td>
                                                    <td>{{ $post->created_at }}</td>
                                                    <td>{{ $post->is_published }}</td>
                                                    @if (request()->status !== 'disabled')
                                                        <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="" class="badge bg-primary ">
                                                                    <a target="_blank"
                                                                        href="{{ route('admin.posts.edit', $post->id) }}"
                                                                        style="color:#fff">Sửa</a>
                                                                </span>
                                                                <span class="badge bg-danger delete_post">
                                                                    <a href="{{ route('admin.posts.delete', $post->id) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop-{{ $post->id }}"
                                                                        style="color:#fff">Xóa </a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="" class="badge bg-success ">
                                                                    <a href="{{ route('admin.posts.restore', $post->id) }}"
                                                                        style="color:#fff">Restore</a>
                                                                </span>
                                                                <span class="badge bg-dark delete_post">
                                                                    <a href="{{ route('admin.posts.delete', $post->id) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop-{{ $post->id }}"
                                                                        style="color:#fff">forceDelete </a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop-{{ $post->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Delete
                                                                    Post
                                                                    <b>{{ $post->title }}</b>
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-toggle="modal" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are U sure?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">No</button>
                                                                @if (request()->status !== 'disabled')
                                                                    <a href="{{ route('admin.posts.delete', $post->id) }}"
                                                                        type="button" class="btn btn-danger">Yes</a>
                                                                @else
                                                                    <a href="{{ route('admin.posts.forceDelete', $post->id) }}"
                                                                        type="button" class="btn btn-danger">Yes</a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <x.admin.post-modal :post="$post"
                                                :deleteRoute="{{ route('admin.posts.delete', $post->id) }}"
                                                :modelType="'post'" /> --}}
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
@endsection
