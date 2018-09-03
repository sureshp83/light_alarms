<template>
    <div>
        <label :for="id" v-text="txt_upload"></label>

        <div class="custom-file">
            <input
                type="file"
                :id="id"
                :name="field"
                class="custom-file-input"
                @change="onChange">
            <label class="custom-file-label"
                :for="id"
                v-text="fileName ? fileName : txt_choose"
            ></label>
        </div>

        <small class="form-text text-primary"
            v-if="fileName">
            <b-btn
                class="m-0 p-0 text-primary"
                variant="link"
                @click="onReset">
                <i class="fa fa-btn fa-times"></i>
                <span v-text="txt_remove"></span>
            </b-btn>
        </small>
    </div>
</template>

<script>
export default {
    props: [
        'id',
        'field',
        'txt_upload',
        'txt_choose',
        'txt_remove',
    ],

    data() {
        return {
            image:    '',
            fileName: '',
        }
    },

    methods: {
        onChange(ev) {
            let files = ev.target.files || ev.dataTransfer.files;

            if (!files.length) {
                return
            }

            if (files[0].name === this.fileName) {
                return
            }

            this._createImage(files[0])
        },


        onReset() {
            this.fileName = '';
            this.$emit('change', '');
        },


        _createImage(file) {
            this.fileName = file.name

            let reader = new FileReader();

            reader.onload = (e) => {
                this.image = e.target.result;
                this.$emit('change', file, this.image);
            };

            reader.readAsDataURL(file);
        },
    }
}
</script>
