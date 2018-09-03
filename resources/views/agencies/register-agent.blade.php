<form
    @submit.prevent="onSubmit"
    role="form"
    enctype="multipart/form-data">
    {{ csrf_field() }}


    <b-alert show variant="text-danger text-center border-0 text-primary"
        v-if="form.errors.any()"
        v-text="form.errors.first()"
        >
    </b-alert>


    <!-- Agency / Phone -->
    <div class="row">
        <div class="col">
            <b-form-group
                id="agency_nameGrp"
                label="{{ __('strings.agency_name') }}"
                label-for="agency_name">
                <b-form-input
                    id="agency_name"
                    ref="agency_name"
                    name="name"
                    type="text"
                    v-model="form.name"
                    required>
                </b-form-input>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('name')"
                    v-text="form.errors.get('name')">
                </small>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group
                id="agency_emailGrp"
                label="{{ __('strings.contact_phone_number') }}"
                label-for="agency_phone">
                <b-form-input
                    id="agency_phone"
                    name="phone"
                    type="text"
                    v-model="form.phone"
                    required>
                </b-form-input>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('phone')"
                    v-text="form.errors.get('phone')">
                </small>
            </b-form-group>
        </div>
    </div>


    <!-- Address / City -->
    <div class="row">
        <div class="col">
            <b-form-group
                id="agency_addressGrp"
                label="{{ __('strings.address') }}"
                label-for="agency_address">
                <b-form-input
                    id="agency_address"
                    name="address"
                    type="text"
                    v-model="form.address"
                    required>
                </b-form-input>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('address')"
                    v-text="form.errors.get('address')">
                </small>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group
                id="agency_cityGrp"
                label="{{ __('strings.city') }}"
                label-for="agency_city">
                <b-form-input
                    id="agency_city"
                    name="city"
                    type="text"
                    v-model="form.city"
                    required>
                </b-form-input>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('city')"
                    v-text="form.errors.get('city')">
                </small>
            </b-form-group>
        </div>
    </div>


    <!-- State / Zip -->
    <div class="row">
        <div class="col">
            <b-form-group
                id="agency_stateGrp"
                state="form.errors.has('state')"
                label="{{ __('strings.state') }}"
                label-for="agency_state">

                <b-select
                    id="agency_state"
                    name="state"
                    :options="{{ json_encode(usaStatesArray()) }}"
                    v-model="form.state"
                    required>
                    <template slot="first">
                        <option
                            value=""
                            selected="selected"
                            disabled>-- {{ __('strings.select_a_state') }} --</option>
                    </template>
                </b-select>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('state')"
                    v-text="form.errors.get('state')">
                </small>
            </b-form-group>
        </div>
        <div class="col w-25">
            <b-form-group
                id="agency_postal_codeGrp"
                label="{{ __('strings.postal_code') }}"
                label-for="agency_postal_code">
                <b-form-input
                    id="agency_postal_code"
                    name="postal_code"
                    type="text"
                    v-model="form.postal_code"
                    required>
                </b-form-input>
                <small class="mt-2 help-block text-danger"
                    v-if="form.errors.has('postal_code')"
                    v-text="form.errors.get('postal_code')">
                </small>
            </b-form-group>
        </div>
    </div>


    <!-- Agency logo -->
    <div class="row mt-2">
        <div class="col">
            <div class="form-group">

                <file-upload
                    id="agency_avatar"
                    field="avatar"
                    txt_upload="{{ __('strings.upload_logo') }}"
                    txt_choose="{{ __('strings.file_choose') }}"
                    txt_remove="{{ __('strings.file_remove') }}"
                    @change="onFileChange"
                >
                </file-upload>
            </div>
        </div>
    </div>


    <div slot="modal-footer" class="pt-3 text-center">
        <b-btn type="submit"
            variant="dark"
            :disabled="form.busy"
            class="mr-1">
            <i v-if="form.busy" class="fa fa-btn fa-spinner fa-spin"></i>
            <span v-text="form.busy ?
                '{{__('strings.actions.registering')}}'
                : '{{__('strings.actions.register')}}'">
            </span>
        </b-btn>

        <b-btn variant="outline-danger" class="ml-1" @click="show=false">
            {{ __('strings.actions.cancel') }}
        </b-btn>
   </div>
</form>
