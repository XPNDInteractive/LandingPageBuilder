@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <form class="bg-white border p-5 rounded" method="POST" action="{{ route('login') }}">
                <h4 class="mb-4">Login to continue!</h4>
                @csrf

                <div class="form-group ">
                    <label for="email" class="  text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class=" form-control bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password" class="  text-md-right">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password" class="form-control bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group  mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-primary btn-block mb-3">
                            {{ __('Login') }}
                        </button>
                        <div class="row m-0 flex-column justify-content-center">
                        @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                        @if (Route::has('register'))
                        <a class="small" href="{{ route('register') }}">
                            {{ __('Join Now') }}
                        </a>
                        @endif
                    </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
