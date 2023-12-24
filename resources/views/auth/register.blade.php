@extends('auth.layout')
@section('title', 'Register')
@section('content')


    <form class="login100-form validate-form" id="registerForm" action="{{ route('auth.register') }}">
        <span class="login100-form-title p-b-49">
            Register
        </span>
        {{-- name --}}
        <div class="wrap-input100 validate-input m-b-23" data-validate="Name  is reauired">
            <span class="label-input100">Name</span>
            <input class="input100" type="text" name="name" placeholder="Type your name ">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>

        {{-- email --}}
        <div class="wrap-input100 validate-input m-b-23" data-validate="Email  is reauired">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" name="email" placeholder="Type your Email ">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>
        {{-- pass --}}
        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>

        {{-- pass --}}
        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password comfirm</span>
            <input class="input100" type="password" name="password_confirmation" placeholder="retype your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>


        <div class="text-right p-t-8 p-b-31">
            <a href="#">
                {{-- Forgot password? --}}
            </a>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    Registger
                </button>
            </div>
        </div>
        <div class="txt1 text-center p-t-54 p-b-20">
            <span>
                Or Sign Up Using
            </span>
        </div>
        
        <div class="flex-c-m">
            <a href="{{ route('auth.redirect.fb') }}" class="login100-social-item bg1">
                <i class="fa fa-facebook"></i>
            </a>
        
            <a href="#" class="login100-social-item bg2">
                <i class="fa fa-twitter"></i>
            </a>
        
            <a href="#" class="login100-social-item bg3">
                <i class="fa fa-google"></i>
            </a>
        </div>


        <div class="flex-col-c p-t-155">
            <span class="txt1 p-b-17">
                Or Sign In Using
            </span>

            <a href="{{ route('auth.login.form') }}" class="txt2">
                Sign In
            </a>
        </div>


    </form>
@endsection
@section('js')
    <script>
        $("#registerForm").submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            });
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
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
                            // window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then((result) => {});
                    }
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 5000
                    }).then((result) => {

                    })
                }
            });
        });
    </script>
@endsection
