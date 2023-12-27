<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>



    <div id="header-wp">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}">HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        @foreach ($categories as $category)
                            
                        <li><a class="dropdown-item" href="{{ route('client.posts.by.category',$category->slug) }}">{{ $category->title }}</a></li>
                        @endforeach
                       
                        </ul>
                    </li>
                    <li class="nav-item active ">
                        <div class="input-group rounded">
                            <form action="{{ route('search') }}" method="get" class="d-flex">
                                <input type="search" class="form-control rounded" name="title" placeholder="title"
                                    aria-label="Search" aria-describedby="search-addon" value="" />
                                <input type="search" class="form-control rounded" name="author" placeholder="author"
                                    aria-label="Search" aria-describedby="search-addon" value="" />
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </li>

                    @auth
                        <li class="nav-item">
                            <div class="btn-group">
                                <button type="button" style="margin-left:20px" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </button>

                                <ul class="dropdown-menu">
                                    @role('admin|writer')
                                        <li><a class="dropdown-item" href="{{ route('client.postsOwner.index') }}">Danh sách bài
                                                viết</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.posts.create') }}">Thêm bài viết</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @endrole

                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

    </div>







    <div id="wp-content">

        <div class="container mt-4">

            <x-admin.alert-notify />
            @yield('content')
        </div>
    </div>


    <footer class="footer">
        <div class="container">
            <p>Rabiloo.....</p>
            <p>&copy; 2023 Rabiloo</p>
        </div>
    </footer>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#notification').fadeOut('slow');
            }, 3000);
        })
    </script>
    @yield('js')
</body>

</html>
