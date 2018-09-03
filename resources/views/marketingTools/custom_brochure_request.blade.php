@extends("layouts.master")

@section("content")
    @php
        $agency = Auth::user()->agency();
    @endphp

<custom-brochure-request
    email         = "{{ Auth::user()->email }}"
    agent_name    = "{{ Auth::user()->name }}"
    agent_phone   = "{{ Auth::user()->phone }}"
    agency_name   = "{{ $agency->name }}"
    agent_address = "{{ $agency->address }}"
    agent_city    = "{{ $agency->city }}"
    agent_state    = "{{ $agency->state_province }}"
    agent_zip  = "{{ $agency->postal_code }}"

    inline-template v-cloak>
    <div class="row" id="custom_brochure_request"><div class="col col-md-12 col-lg-10">
    <form @submit.prevent="onSubmit" role="form">

        <h1>{{trans("strings.custom_brochure.title")}}</h1>
        <div class="form-row">
            <div class="form-group col-xs-12 col-sm-10 col-md-10 text-secondary">
                {!! trans("strings.custom_brochure.intro") !!}
            </div>
        </div>


        @include('marketingTools.inc.custom_brochure_form')


        <h6 class="border-bottom mt-5 mb-4 pb-2 text-uppercase font-weight-bold">
            {{ __('strings.custom_brochure.information') }}
        </h6>

        <div class="form-_ row mt-2">
            <div class="form-group col-md-12 col-xl-4 pr-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            1. {{ __('strings.custom_brochure.choose_brand') }}
                        </h5>
                        <b-form-radio-group v-model.sync="brand" name="brand" stacked>
                            <b-form-radio
                                class="mb-2"
                                v-for="brand in brands"
                                :value="brand"
                                @change="onChangeBrand(brand)"
                                >@{{ brand }}
                            </b-form-radio>
                        </b-form-radio-group>
                    </div>
                </div>
            </div>


            <div class="form-group col-md-12 col-xl-4 pr-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            2. {{ __('strings.custom_brochure.select_target_market') }}
                        </h5>
                        <b-form-radio-group v-model="market" name="marketOptions" stacked>
                            <b-form-radio
                                class="mb-2"
                                v-for="market in markets"
                                :value="market"
                                @change="onChangeMarket(market)"
                                >@{{ market }}
                            </b-form-radio>
                        </b-form-radio-group>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 col-xl-4 pl-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            3. {{ __('strings.custom_brochure.option_include') }}
                        </h5>
                        <b-form-checkbox-group
                            v-model="optional"
                            name="optionalbrand"
                            stacked>
                            <b-form-checkbox class="mb-2" value="Nexus information">
                                {{ __('strings.custom_brochure.nexus_info') }}
                            </b-form-checkbox>
                            <b-form-checkbox class="mb-2" value="LED Benefits">
                                {{ __('strings.custom_brochure.led_benefits') }}
                            </b-form-checkbox>
                        </b-form-checkbox-group>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group mt-2 pb-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        4. {{ __('strings.custom_brochure.select_products') }}
                    </h5>
                    <b-form-checkbox-group
                        v-model="products"
                        name="products" stacked>
                        <b-form-checkbox
                            class="mb-2"
                            v-for="(prod, prodKey) in productsData"
                            :value="prod.product">@{{ prod.product }}
                        </b-form-checkbox>
                    </b-form-checkbox-group>
                </div>
            </div>
        </div>



        <div class="form-group text-right">
            <button class="btn btn-lg btn-dark" type="submit" role="button">
                {{ __('strings.actions.send_request') }}
            </button>
        </div>
    </form>
</div></div>
</custom-brochure-request>
@endsection
