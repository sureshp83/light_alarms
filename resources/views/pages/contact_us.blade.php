@extends("layouts.master")

@section('page_title')
    {{ __('strings.title.get_in_touch_with_us') }}
@endsection

@section("content")
    <div class="row mb-5">
        <h1>{{ __('strings.title.get_in_touch_with_us') }}</h1>
    </div>
    <div class="row">
        <div class="bgcolor">
            <div class="col-25 p-5 mr-4 bg-light">
                <h5 class="text-dark">
                    <strong>{{ __('strings.title.contact_info') }}</strong>
                </h5>

                <address class="mt-4">
                    <strong>{{ __('strings.address') }}</strong><br>
                    {{$agency_detail->name}}<br>
                    {{($agency_detail->address)?$agency_detail->address:""}},<br>
                    {{($agency_detail->city)?$agency_detail->city:""}}, {{($agency_detail->state_province)?$agency_detail->state_province:""}} {{($agency_detail->postal_code)?$agency_detail->postal_code:""}}<br>
                </address>
                <address class="mt-1">
                    <strong>{{ __('strings.regional_manager') }}</strong><br>
                    {{$agency_detail->name}}<br>
                    {{$user->email}}<br>
                    <abbr title="Phone">Tel:</abbr> {{$agency_detail->phone}}
                </address>
                <address class="mt-1">
                    <strong>{{ __('strings.inside_sales_cs') }}</strong><br>
                    {{$agency_detail->name}}<br>
                    {{$user->email}}<br>
                    <abbr title="Phone">Tel:</abbr> {{$agency_detail->phone}}<br>

                </address>
                <address class="mt-1">
                    <strong>{{ __('strings.technical_support') }}</strong><br>
                    {{$agency_detail->name}}<br>
                    {{$user->email}}<br>
                    {{($agency_detail->address)?$agency_detail->address:""}},<br>
                    {{($agency_detail->city)?$agency_detail->city:""}}, {{($agency_detail->state_province)?$agency_detail->state_province:""}} {{($agency_detail->postal_code)?$agency_detail->postal_code:""}}<br>
                    <abbr title="Phone">Tel:</abbr> {{$agency_detail->phone}}<br>

                </address>
            </div>
        </div>
        <div class="col ml-4">
            <h3><span class='text-primary'>Live chat</span></h3>
            <p>Our insides sales and customer support team is here for you from 8:30 a.m. to 5:00 p.m. Eastern Time.</p>
            <p>Enter your question bellow and we'll find the answer.</p>
            <br>
            <h3><span class='text-primary'>By phone or by email</span></h3>
            <p>Sometimes it's easier to solve a problem by phone or by email. Our team is available to help.</p>
            <p><strong>Inside Sales</strong>: for pricing and quotations; and order and quote revisions.</p>
            <p><strong><span style='color: #000000;'>Customer Service</span></strong>: for return merchandise authorizations (RMAs), order follow-up, stock checks a, and shipping information</p>
            <p><strong>Technical Support</strong>&nbsp;for single point equipment exit signs, the Nexus monitor system, and inverters. Also for quotes and pricing on inverters.</p>
            <p><strong>Regional Manager</strong>&nbsp;for sales, quotations, and product application information.</p>
            <p>Not sure? Call inside Sales.</p>
        </div>
    </div>
@endsection
