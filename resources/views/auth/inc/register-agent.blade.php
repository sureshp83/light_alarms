<!-- Agency / Phone -->
<div class="row">
    <div class="col">
        <b-form-group
            id="agency_nameGrp"
            label="{{ __('strings.agency_name') }}"
            label-for="agency_name">
            <b-form-input
                id="agency_name"
                name="agency_name"
                type="text"
                v-model="form.agency_name"
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
                name="agency_phone"
                type="text"
                v-model="form.agency_phone"
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
                name="agency_address"
                type="text"
                v-model="form.agency_address"
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
                name="agency_city"
                type="text"
                v-model="form.agency_city"
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
            label="{{ __('strings.state') }}"
            label-for="agency_state">

            {!! usaStates('') !!}

            <small class="mt-2 help-block text-danger"
                v-if="form.errors.has('state')"
                v-text="form.errors.get('state')">
            </small>
        </b-form-group>
    </div>
    <div class="col w-25">
        <b-form-group
            id="agency_zipGrp"
            label="{{ __('strings.zip_code') }}"
            label-for="agency_zip">
            <b-form-input
                id="agency_zip"
                name="agency_zip"
                type="text"
                v-model="form.agency_zip"
                required>
            </b-form-input>
            <small class="mt-2 help-block text-danger"
                v-if="form.errors.has('zip')"
                v-text="form.errors.get('zip')">
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
                field="agency_avatar"
                txt_upload="{{ __('strings.upload_agency_logo') }}"
                txt_choose="{{ __('strings.file_choose') }}"
                txt_remove="{{ __('strings.file_remove') }}"
                @change="onAgencyAvatarChange"
            >
            </file-upload>

        </div>
    </div>
</div>

{{--
<div class="row mt-2">
    <div class="col">
        <b-form-group
            id="agency_avatarGrp02"
            label="{{ __('strings.upload_agency_logo') }}"
            label-for="agency_avatar02">


            <picture-input
                :width="400"
                :height="50"
                button-class="dark"
                :name="form.agency_avatar">
            </picture-input>


            <b-form-file
                id="agency_avatar02"
                ref="agency_avatar02"
                name="agency_avatar"
                v-model="form.agency_avatar"
                accept="image/*"></b-form-file>
            <b-button @click="onAgencyAvatarReset">Reset</b-button>
        </b-form-group>
    </div>
</div>
 --}}
