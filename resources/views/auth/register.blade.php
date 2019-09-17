@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <form class="bg-white border p-5 rounded" method="POST" action="{{ route('register') }}">
                <h4 class="mb-3 text-primary">Sign up to get access!</h4>
                <p class="small mb-4">We offer exlusive apps to help you reach your marketing goals.</p>
                @csrf

                <div class="form-group ">
                    <label for="name" class=" text-md-right">{{ __('Name') }}</label>

                    <div class="">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password" class=" text-md-right">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password-confirm" class=" text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group mt-4  mb-4">
                    <div class="">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                <a class="small" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
