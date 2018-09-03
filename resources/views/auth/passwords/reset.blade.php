@extends('layouts.auth')

@section('content')
<div class="auth">
    @include('auth.inc.brand')

    <div class="auth__wrap">
        <h1 class="auth__title">{{ __('auth.header.pass_recovery') }}</h1>
        <p class="mx-auto mb-4 w-75 text-center">{{ __('auth.legend.pass_recovery') }}</p>

        <div class="card auth__card px-3 w-50 mx-auto">
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{ __('auth.inp.email') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ $email or old('email') }}" required autofocus>
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

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password">{{ __('auth.inp.password_retype') }}</label>
                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="text-center py-3">
                    <button type="submit" class="btn btn-dark">
                        {{ __('auth.btn.pass_reset') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
