<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Casino || Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
   <style type="text/css">

        .modal-login {
            color: #000000;
            max-width: 450px;
        }

        .modal-login .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            margin-top: 20%;
        }
        .modal-login .modal-header {
            border-bottom: none;
            position: relative;
            justify-content: center;
        }
        .modal-login h4 {
            text-align: center;
            font-size: 26px;
        }
        .modal-login  .form-group {
            position: relative;
        }
        .modal-login i {
            position: absolute;
            left: 13px;
            top: 11px;
            font-size: 18px;
        }
        .modal-login .form-control {
            padding-left: 40px;
        }
        .modal-login .form-control:focus {
            border-color: #12b5e5;
        }
        .modal-login .form-control, .modal-login .btn {
            min-height: 40px;
            border-radius: 3px;
            transition: all 0.5s;
        }
        .modal-login .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .modal-login input[type="checkbox"] {
            margin-top: 1px;
        }
        .modal-login .forgot-link {
            color: #12b5e5;
            float: right;
        }
        .modal-login .btn {
            background: #12b5e5;
            border: none;
            line-height: normal;
        }
        .modal-login .btn:hover, .modal-login .btn:focus {
            background: #10a3cd;
        }
        .modal-login .modal-footer {
            color: #999;
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            margin-top: -20px;
            justify-content: center;
        }
        .modal-login .modal-footer a {
            color: #12b5e5;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
        .invalid-feedback {
            color: red;
        }
    </style>
</head>
<body style="background:#000000">
<!-- Modal HTML -->
<div id="" class="">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{($type==0?'Affiliate  ':'Admin  '). __('Login') }}</h4>
            </div>
            @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
            <div class="modal-body">
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="hidden" name="type" value="{{$type}}">
                        <input id="email" type="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div> --}}
        </div>
    </div>
</div>
<script src="{{ asset('frontend/asset') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('js/toastr.js')}}"></script>
            {!! Toastr::message() !!}
            <script>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        toastr.error('{{ $error }}','Error',{
                            closeButton:true,
                            progressBar:true,
                        });
                    @endforeach
                @endif
            </script>
</body>
</html>
