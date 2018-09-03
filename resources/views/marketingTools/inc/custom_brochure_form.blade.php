    <div class="form-group">
        <h6 class="border-bottom mt-3 pb-2 text-uppercase font-weight-bold">
            {{ __('strings.custom_brochure.ship_info') }}
        </h6>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="clientName">{{trans("strings.client_name")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="clientName"
                name="clientName"
                v-model="client_name"
                value=""
                required="required">
        </div>
        <div class="col-md-4">
            <label for="email">{{trans("strings.email")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="email"
                name="email"
                v-model="email">
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="agentName">{{trans("strings.agent_name")}}</label>
            <input type="text"
                class="border-0 form-control form-control-lg"
                id="agentName"
                name="agentName"
                v-model="agent_name"
                readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="agentPhoneNumber">{{trans("strings.agent_phone_number")}}</label>
            <input type="text"
                class="border-0 form-control form-control-lg"
                id="agentPhoneNumber"
                name="agentPhoneNumber"
                v-model="agent_phone"
                readonly>
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="agencyName">{{trans("strings.agency_name")}}</label>
            <input type="text"
                class="border-0 form-control form-control-lg"
                id="agencyName"
                name="agencyName"
                v-model="agency_name"
                readonly>
        </div>
        <div class="col-md-4"></div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="agentAddress">{{trans("strings.address")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="agentAddress"
                name="agentAddress"
                v-model="agent_address"
                required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="agentCity">{{trans("strings.city")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="agentCity"
                name="agentCity"
                v-model="agent_city"
                value="{{ $agency->city }}"
                required="required">
        </div>
    </div>


    <div class="form-row pt-2">
        <div class="form-group col-md-8 pr-4">
            <label for="agency_state">{{trans("strings.state")}}</label>
            <b-select
                class="form-control form-control-lg"
                id="agency_state"
                name="agentState"
                :options="{{ json_encode(usaStatesArray()) }}"
                v-model="agent_state"
                required>
            </b-select>
        </div>
        <div class="form-group col-md-4">
            <label for="agentZipCode">{{trans("strings.zip_code")}}</label>
            <input type="text"
                class="form-control form-control-lg"
                id="agentZipCode"
                name="agentZipCode"
                v-model="agent_zip"
                value="{{ $agency->postal_code }}"
                required="required">
        </div>
    </div>
