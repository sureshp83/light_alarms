@extends('layouts.auth')

@section('content')
<div class="auth">
    @include('auth.inc.brand')

    <div class="auth__wrap">
        <h1 class="auth__title">{{ __('auth.header.login') }}</h1>
        <p class="mx-auto mb-4 w-75 text-center">{{ __('auth.legend.login') }}</p>

        <div class="card auth__card px-3 w-50 mx-auto">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{ __('auth.inp.email') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg" name="email"
                           value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">{{ __('auth.inp.password') }}</label>
                    <input id="password" type="password" class="form-control form-control-lg" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="text-center py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        {{ __('auth.btn.login') }}
                    </button>
                    <a class="mt-1 btn btn-link" href="{{ route('password.request') }}">
                        {{ __('auth.btn.forgot_password') }}
                    </a>
                </div>
            </form>
        </div>


        <div class="text-center py-4">
            <span>{{ __('auth.txt.dont_have_account') }}</span>
            <a class="ml-3 btn btn-outline-primary"
                href="{{ route('register') }}"
                role="button">
                {{ __('auth.btn.register') }}
            </a>
        </div>
    </div>
</div>
@endsection
