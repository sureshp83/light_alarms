@extends('layouts.auth')

@section('content')
<div class="auth d-flex flex-column mt-5 m-auto">
    @include('auth.inc.brand')

    <div class="auth__wrap">
        <h1 class="auth__title">{{ __('auth.header.registered') }}</h1>
        <p class="card auth__card mx-auto pb-4 w-75 text-center">
            {!! __('auth.legend.registered') !!}
        </p>

        <div class="text-center py-3">
            <span>{{ __('auth.txt.didnt_receive_email') }}</span>
            <a class="ml-3 btn btn-outline-primary"
                href="mailto:lightalarms-info@tnb.com"
                role="button">
                {{ __('auth.btn.contact_us') }}
            </a>
        </div>
    </div>
</div>
@endsection
