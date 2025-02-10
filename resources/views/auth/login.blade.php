@extends('backend.layouts.layout')

@section('content')

<div class="row no-gutters bg-white" style="min-height:100vh;">
    <!-- Left Side Image-->
    <div class="col-xxl-6 col-lg-7">
        <div class="h-100">
            <img src="{{ uploaded_asset(get_setting('admin_login_background')) }}" alt="" class="img-fit h-100">
        </div>
    </div>
    
    <!-- Right Side -->
    <div class="col-xxl-6 col-lg-5">
        <div class="right-content">
            <div class="row align-items-center justify-content-center justify-content-lg-start h-100">
                <div class="col-xxl-6 p-4 p-lg-5">
                    <!-- Site Icon -->
                    <div class="size-48px mb-3 mx-auto mx-lg-0">
                        @if(get_setting('system_logo_black') != null)
                            <img src="{{ uploaded_asset(get_setting('system_logo_black')) }}" class="img-fir h-100">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" class="img-fit h-100">
                        @endif
                    </div>
                    <!-- Titles -->
                    <div class="text-center text-lg-left">
                        <h1 class="fs-20 fs-md-20 fw-700 text-primary">{{ translate('Welcome to') }} {{ env('APP_NAME') }}</h1>
                        <h5 class="fs-14 fw-400 text-dark">{{ translate('Login to your account.') }}</h5>
                    </div>
                    <!-- Login form -->
                    <div class="pt-3 pt-lg-4 bg-white">
                        <div class="">
                            <form class="form-default" method="POST" role="form" action="{{ route('login') }}">
                                @csrf  
                                <!-- Email-->
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ translate('Email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    
                                    <div class="position-relative">
                                    <input id="password" type="password" class="form-control rounded-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ translate('Password') }}">
                                        <i class="password-toggle las la-2x la-eye"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="text-left">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span>{{ translate('Remember Me') }}</span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                                        <div class="col-sm-6">
                                            <div class="text-right">
                                                <a href="{{ route('password.request') }}" class="text-reset fs-14">{{translate('Forgot password ?')}}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ translate('Login') }}
                                </button>
                            </form>

                            <!-- DEMO MODE -->
                            @if (env("DEMO_MODE") == "On")
                                <div class="mt-4">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>admin@example.com</td>
                                                <td>123456</td>
                                                <td><button class="btn btn-info btn-xs" onclick="autoFill()">{{ translate('Copy') }}</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>

<script>
    (function ($) {
        // USE STRICT
        "use strict";

        AIZ.data = {
            csrf: $('meta[name="csrf-token"]').attr("content"),
            appUrl: $('meta[name="app-url"]').attr("content"),
            fileBaseUrl: $('meta[name="file-base-url"]').attr("content"),
        };
        AIZ.plugins = {
            notify: function (type = "dark", message = "") {
                $.notify(
                    {
                        // options
                        message: message,
                    },
                    {
                        // settings
                        showProgressbar: true,
                        delay: 2500,
                        mouse_over: "pause",
                        placement: {
                            from: "bottom",
                            align: "left",
                        },
                        animate: {
                            enter: "animated fadeInUp",
                            exit: "animated fadeOutDown",
                        },
                        type: type,
                        template:
                            '<div data-notify="container" class="aiz-notify alert alert-{0}" role="alert">' +
                            '<button type="button" aria-hidden="true" data-notify="dismiss" class="close"><i class="las la-times"></i></button>' +
                            '<span data-notify="message">{2}</span>' +
                            '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            "</div>" +
                            "</div>",
                    }
                );
            }
        };

    })(jQuery);
</script>
<script>
    
    $('.password-toggle').click(function(){
        var $this = $(this);
        if ($this.siblings('input').attr('type') == 'password') {
            $this.siblings('input').attr('type', 'text');
            $this.removeClass('la-eye').addClass('la-eye-slash');
        } else {
            $this.siblings('input').attr('type', 'password');
            $this.removeClass('la-eye-slash').addClass('la-eye');
        }
    });
</script>
@endsection
