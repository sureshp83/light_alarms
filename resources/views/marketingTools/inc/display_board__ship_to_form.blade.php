    <div class="form-group">
        <h6 class="border-bottom mt-3 pb-2 text-uppercase font-weight-bold">
            {{ __('strings.ship_to') }}
        </h6>
    </div>

    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="contact_name">{{trans("strings.contact_name")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="contact_name"
                name="contact_name"
                value="{{ Auth::user()->name }}">
        </div>
        <div class="form-group col-md-4">
            <label for="contact_phone_number">{{trans("strings.contact_phone_number")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="contact_phone_number"
                name="contact_phone_number"
                value="{{ Auth::user()->phone }}">
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="company">{{trans("strings.company")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="company"
                name="company"
                value="{{ $agency->name }}">
        </div>
        <div class="form-group col-md-4">
            <label for="ship_date">{{trans("strings.request_receiving_date")}}</label>
            <input type="date"
                class="form-control form-control-lg"
                id="ship_date"
                name="ship_date"
                min="{{\Carbon\Carbon::now()->addDay(14)->format('Y-m-d')}}"
                {{-- value="{{\Carbon\Carbon::now()->addDay()}}" --}}
                required="required">
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="address">{{trans("strings.address")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="address"
                name="address"
                value="{{ $agency->address }}"
                required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="city">{{trans("strings.city")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="city"
                name="city"
                value="{{ $agency->city }}"
                required="required">
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="state">{{trans("strings.state")}}</label>
            {!! usaStates('state', 'form-control-lg custom-select', $agency->state_province) !!}
        </div>
        <div class="form-group col-md-4">
            <label for="zip_code">{{trans("strings.zip_code")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="zip_code"
                name="zip_code"
                value="{{ $agency->postal_code }}"
                required="required">
        </div>
    </div>


    <div class="form-group pt-2">
        <label for="special_instructions">{{trans("strings.special_instructions")}}</label>
        <textarea
            id="special_instructions"
            name="special_instructions"
            class="form-control form-control-lg"
            rows="3"
        ></textarea>
    </div>

