<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên vai trò</th>
            <th scope="col">Mô tả vai trò</th>

            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $temp = 1;
        @endphp
        @foreach ($roles as $role)
            <tr>
                <td scope="col">{{ $temp++ }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}" title="Sửa {{ $role->name }}">Sửa</a> /
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $role->id }}"
                        title="Xóa {{ $role->name }}">Xóa</a>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal-{{ $role->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa vài trò {{ $role->name }} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có muốn xóa ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-primary" href="{{ route('admin.roles.delete', $role->id) }}">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach





    </tbody>
</table>


