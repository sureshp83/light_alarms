module.exports = {
    props: ['endpoint'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new Form({
                usrtype:               '',
                name:                  '',
                email:                 '',
                password:              '',
                password_confirmation: '',
                phone:                 '',
                phone_ext:             '',
                agency:                '',
                agree_check:           '',
            }),
        }
    },


    mounted() {
        // This hidden input requires the default value.
        // This should be applied to other case scenarios.
        this.form.usrtype = this.$refs.usrtype.value
    },


    methods: {
        onSubmit() {
            this.form.post(this.endpoint)
                .then(res => this.onSuccess())
                .catch(err => {
                    // handle error if required
                    // console.log(err);
                });
        },


        onSuccess() {
            window.location.href = '/registered'
        },

        onPassChange(inp, value) {
            this.form[inp] = value
        },
    },
};
