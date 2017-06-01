@extends('layouts.material.app-full')

@section('content')

    <div class="bg-full-page bg-primary back-fixed">
        <div class="mw-500 absolute-center">
            <div class="card animated zoomInDown animation-delay-5">
                <div class="card-block">
                    <h1 class="color-primary">Login</h1>
                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group label-floating{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="zmdi zmdi-account"></i>
                                    </span>
                                    <label class="control-label" for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group label-floating{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="zmdi zmdi-lock"></i>
                                </span>
                                    <label class="control-label" for="ms-form-pass">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <button class="btn btn-raised btn-primary btn-block">Login
                                        <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i>
                                    </button>
                                </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<button class="btn btn-primary btn-block">--}}
                                        {{--<i class="zmdi zmdi-account-add mr-1"></i> Sign Up</button>--}}
                                {{--</div>--}}
                            </div>
                        </fieldset>
                    </form>
                    {{--<div class="text-center">--}}
                        {{--<h3 class="color-dark">Login with</h3>--}}
                        {{--<a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-facebook">--}}
                            {{--<i class="zmdi zmdi-facebook"></i> Facebook</a>--}}
                        {{--<a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-twitter">--}}
                            {{--<i class="zmdi zmdi-twitter"></i> Twitter</a>--}}
                        {{--<a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-google">--}}
                            {{--<i class="zmdi zmdi-google"></i> Google</a>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="text-center animated fadeInUp animation-delay-7">
                <a href="/" class="btn btn-white">
                    <i class="zmdi zmdi-home"></i> Go Home</a>
                <a href="{{ route('password.request') }}" class="btn btn-white">
                    <i class="zmdi zmdi-key"></i> Recovery Pass</a>
            </div>
        </div>
    </div>

@endsection
