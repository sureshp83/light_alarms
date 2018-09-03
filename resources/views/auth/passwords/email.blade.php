@extends('layouts.auth')

@section('content')
<div class="auth">
    @include('auth.inc.brand')

    <div class="auth__wrap">
        <h1 class="auth__title">{{ __('auth.header.pass_recovery') }}</h1>
        <p class="mx-auto mb-4 w-75 text-center">{{ __('auth.legend.pass_recovery') }}</p>

        @if (session('status'))
            <div class="mx-auto mb-4 w-75 text-center text-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card auth__card px-3 w-50 mx-auto">
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">{{ __('auth.inp.email') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="text-center py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        {{ __('auth.btn.pass_recovery') }}
                    </button>
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('auth.btn.return_to_login') }}
                    </a>
                </div>
            </form>
        </div>

        <div class="text-center py-4">
            <span>{{ __('auth.txt.need_help') }}</span>
            <a class="ml-3 btn btn-outline-primary"
                href="#contact-us"
                role="button">
                {{ __('auth.btn.contact_us') }}
            </a>
        </div>
    </div>
</div>
@endsection
