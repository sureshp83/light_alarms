<template>
    <div class="input-group input_with_btn">
        <input
            class="form-control form-control-lg input_with_btn--input"
            :id="id"
            :type="[showPass ? 'text' : 'password']"
            ref="pwdinp"
            v-model="value"
            @blur="showPass = false"
            @input="$emit('change', name, $event.target.value)"
            required>

        <span class="input_with_btn--btn d-flex align-items-center">
            <button class="btn btn-link px-3"
                    type="button"
                    @click="toggle">
                <span
                    class="fa"
                    :class="[showPass ? 'fa-eye' : 'fa-eye-slash']"
                ></span>
            </button>
        </span>
    </div>
</template>

<script>
export default {
    props: ['id', 'name'],

    data() {
        return {
            value:   '',
            showPass: false,
        }
    },
    methods: {
        toggle() {
            if (this.value === '') return

            this.showPass = ! this.showPass

            this.$refs.pwdinp.focus()
        },
    }
}
</script>
