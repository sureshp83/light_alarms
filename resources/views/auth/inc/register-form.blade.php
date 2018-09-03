<user-register endpoint="{{ route('register') }}" inline-template v-cloak>

    <form @submit.prevent="onSubmit" role="form">
        {{ csrf_field() }}

        <b-alert show variant="text-danger text-center border-0 text-primary"
            v-if="form.errors.any()"
            v-text="form.errors.first()"
            >
        </b-alert>

        <input
            type="hidden"
            ref="usrtype"
            name="usrtype"
            value="{{ $_type }}" />

        <fieldset class="text-uppercase">
            {{ __('auth.fieldset.agency_admin_info') }}
        </fieldset>

        {{-- Name / Email --}}
        <div class="row">
            <div class="col">
                <b-form-group
                    id="{{$_type}}_nameGroup"
                    :state="form.errors.has('name')"
                    label="{{ __('auth.inp.name') }}"
                    label-for="{{$_type}}_name">
                    <b-form-input
                        id="{{$_type}}_name"
                        size="lg"
                        name="name"
                        type="text"
                        v-model="form.name"
                        required>
                    </b-form-input>
                    <small class="mt-2 help-block is-danger"
                        v-text="form.errors.get('name')"></small>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group
                    id="{{$_type}}_emailGroup"
                    label="{{ __('auth.inp.email') }}"
                    label-for="{{$_type}}_email">
                    <b-form-input
                        id="{{$_type}}_email"
                        size="lg"
                        name="email"
                        type="email"
                        v-model="form.email"
                        required>
                    </b-form-input>
                    <small class="mt-2 help-block text-danger"
                        v-if="form.errors.has('email')"
                        v-text="form.errors.get('email')">
                    </small>
                </b-form-group>
            </div>
        </div>


        {{-- Password / Confirmation --}}
        <div class="row">
            <div class="col">
                <div class="form-group"
                    :class="form.errors.has('password') ? 'has-error' : ''">
                    <label for="{{$_type}}_password" class="col-form-label">
                        {{ __('auth.inp.password') }}
                    </label>

                    <show-password
                        id="{{$_type}}_password"
                        name="password"
                        @change="onPassChange"
                    ></show-password>
                    <small class="mt-2 help-block text-danger"
                        v-if="form.errors.has('password')"
                        v-text="form.errors.get('password')">
                    </small>
                </div>
            </div>
            <div class="col">
                <div class="form-group"
                    :class="form.errors.has('password_confirmation') ? 'has-error' : ''">
                    <label for="{{$_type}}_password_confirmation" class="col-form-label">
                        {{ __('auth.inp.password_retype') }}
                    </label>

                    <show-password
                        id="{{$_type}}_password_confirmation"
                        name="password_confirmation"
                        @change="onPassChange"
                    ></show-password>
                    <small class="mt-2 help-block text-danger"
                        v-if="form.errors.has('password_confirmation')"
                        v-text="form.errors.get('password_confirmation')">
                    </small>
                </div>
            </div>
        </div>


        {{-- Phone / Ext --}}
        <div class="row">
            <div class="col">
                <b-form-group
                    id="{{$_type}}_phoneGrp"
                    :state="form.errors.has('phone')"
                    label="{{ __('auth.inp.contact_number') }}"
                    label-for="{{$_type}}_phone">
                    <b-form-input
                        id="{{$_type}}_phone" type="text"
                        name="phone"
                        size="lg"
                        v-model="form.phone"
                        required>
                    </b-form-input>
                    <small class="mt-2 help-block text-danger"
                        v-if="form.errors.has('phone')"
                        v-text="form.errors.get('phone')">
                    </small>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group
                    id="{{$_type}}_phoneGrp"
                    :state="form.errors.has('phone_ext')"
                    label="Ext."
                    label-for="{{$_type}}_phone_ext">
                    <b-form-input
                        id="{{$_type}}_phone_ext" type="text"
                        name="phone_ext"
                        size="lg"
                        v-model="form.phone_ext"
                    ></b-form-input>
                    <small class="mt-2 help-block text-danger"
                        v-if="form.errors.has('phone_ext')"
                        v-text="form.errors.get('phone_ext')">
                    </small>
                </b-form-group>
            </div>
        </div>


        <fieldset class="text-uppercase">
            {{ __('auth.fieldset.global_info') }}
        </fieldset>

        <div class="row mb-2">
            <div class="col">
                <div class="form-group{{ $errors->has('agency') ? ' has-error' : '' }}">
                    <label for="{{$_type}}_inpAgency" class="control-label">
                        {{ __('auth.inp.choose_agency') }}
                    </label>
                    <agency-input-select
                        id="{{$_type}}_inpAgency"
                        name="agency"
                        size="lg"
                        required="required"
                        txtdefault="{{ __('strings.select_an_option') }}"
                        @change="(id) => form.agency = id"
                        >
                    </agency-input-select>
                </div>

                @if ($_type === 'agency_admin')
                    <div class="form-text mt-3">
                        {{ __('auth.txt.cant_find_agency') }}

                        {{-- Register Agency Modal --}}
                        <b-btn v-b-modal.modalAgency
                            class="my-0 py-0 text-primary"
                            variant="link">
                            {{ __('auth.btn.add_agency') }}
                        </b-btn>
                    </div>
                @endif
            </div>
        </div>


        {{-- Terms & Conditions --}}
        <fieldset class="text-uppercase mt-5">
            {{ __('auth.fieldset.terms_conditions') }}
        </fieldset>
        <div class="row mb-4">
            <div class="col">
                <div class="form-group{{ $errors->has('agree_check') ? ' has-error' : '' }}">
                    <textarea name="terms"
                        class="form-control"
                        rows="6"
                        readonly>{{ __('strings.terms_conditions') }}</textarea>
                </div>
                <div class="text-center">
                    <b-form-checkbox
                        name="agree_check"
                        id="{{$_type}}_agree_check"
                        class="_custom-control-input"
                        v-model="form.agree_check"
                        required>
                        <label for="{{$_type}}_agree_check" class="custom-control-label">
                            {{ __('auth.inp.i_agree') }}
                        </label>
                    </b-form-checkbox>
                </div>
            </div>
        </div>

        <div class="text-center">
            <b-btn type="submit"
                variant="dark"
                size="lg"
                :disabled="form.busy">
                <i v-if="form.busy" class="fa fa-btn fa-spinner fa-spin"></i>
                <span
                    v-text="form.busy ? '{{__('auth.btn.registering')}}' : '{{__('auth.btn.register')}}'">
                </span>
            </b-btn>
        </div>
    </form>
</user-register>
