<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên quyền</th>
            <th scope="col">Slug </th>

            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $temp = 1;
        @endphp
        @foreach ($tags as $tag)
            <tr>
                <td scope="col">{{ $temp++ }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <td>
                    <a href="{{ route('admin.tags.edit', $tag->id) }}" title="Sửa {{ $tag->title }}">Sửa</a> /
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $tag->id }}"
                        title="Xóa {{ $tag->title }}">Xóa</a>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal-{{ $tag->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa tag {{ $tag->title }} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có muốn xóa ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-primary" href="{{ route('admin.tags.delete', $tag->id) }}">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach





    </tbody>
</table>
