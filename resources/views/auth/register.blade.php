@extends('layouts.auth')

@section('content')
<div class="auth d-flex flex-column mt-5 m-auto">
    @include('auth.inc.brand')

    <div role="tablist" class="auth__wrap">
        <h1 class="auth__title">{{ __('auth.header.register') }}</h1>

        <b-card no-body class="auth__card">
            <div class="auth__header">
                <h5 class="mb-0">
                    <b-btn v-b-toggle.accordionagencyadmin variant="link" class="auth__selector dropdown-toggle">
                        {{ __('auth.btn.im_a_agency_admin') }}
                    </b-btn>
                </h5>
            </div>
            <b-collapse id="accordionagencyadmin" accordion="register-accordion">
                <div class="card-body px-5 pt-0">
                    @include('auth.inc.register-form', [
                        '_type' => 'agency_admin'
                    ])
                </div>
            </b-collapse>
        </b-card>


        <b-card no-body class="auth__card">
            <div class="auth__header">
                <h5 class="mb-0">
                    <b-btn v-b-toggle.accordionagent variant="link" class="auth__selector dropdown-toggle">
                        {{ __('auth.btn.im_a_agent') }}
                    </b-btn>
                </h5>
            </div>
            <b-collapse id="accordionagent" accordion="register-accordion">
                <div class="card-body px-5 pt-0">
                    @include('auth.inc.register-form', [
                        '_type' => 'agent'
                    ])
                </div>
            </b-collapse>
        </b-card>


        <div class="text-center py-4">
            <span class="mr-3">{{ __('auth.txt.already_have_account') }}</span>
            <a class="btn btn-outline-primary"
                href="{{ route('login') }}"
                role="button">
                {{ __('auth.btn.login') }}
            </a>
        </div>
    </div>
</div>


{{-- Register Agency Modal --}}
<agency-register
    endpoint="{{ route('agencies.store') }}"
    inline-template
    v-cloak>

    <b-modal
        id="modalagency"
        ref="modalagency"
        size="lg"
        variant="light"
        body-class="mx-5 p-5"
        centered
        hide-header
        hide-footer
        title="{{ __('strings.add_agency') }}">

        @include('agencies.register-agent')
    </b-modal>
</agency-register>


@endsection
