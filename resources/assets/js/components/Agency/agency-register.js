module.exports = {
    props: ['endpoint'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new Form({
                name:        '',
                phone:       '',
                address:     '',
                city:        '',
                state:       '',
                postal_code: '',
                avatar:      '',
            }, true),
        }
    },


    methods: {
        onSubmit() {
            this.form.post(this.endpoint)
                .then(res => this.onSuccess(res))
                .catch(err => {
                    // handle error if required
                    // console.log(err);
                })
        },


        onSuccess(res) {
            this.$refs.modalagency.hide()

            swal({
                title: res.message,
                icon: "success",
                timer: 2000,
            })

            Bus.$emit('AgencyInputSelectAppend', res.data.id, res.data.name)
        },

        onFileReset() {
            this.form.avatar = ''
            this.$refs.avatar.reset()
        },

        onFileChange(file, image) {
            this.form.avatar = file
        },
    },
};
