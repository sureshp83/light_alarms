<template>
    <div class="image-upload">
        <picture-input
            ref="pictureInput"
            @change="$emit('change', $event)"
            :name="inputName"
            :width="width"
            :height="height"
            :prefill="prefill"
            :prefillOptions="prefillOptions"
            removable="removable"
            margin="0"
            accept="image/jpeg,image/png"
            size="10"
            zindex="100"
            buttonClass="btn btn-sm btn-dark"
            removeButtonClass="btn btn-sm btn-outline-primary"
            :customStrings="{
                drag: 'drag image or click here',
                change: 'Change',
                remove: 'Remove',
            }">
        </picture-input>
    </div>
</template>


<script>
import PictureInput from 'vue-picture-input'

export default {
    name: 'app',

    props: [
        "inputName",
        'width',
        'height',
        "prefill",
        "prefillOptions",
        "removable",
    ],

    data() {
        return {}
    },
    components: {
        PictureInput
    },
    methods: {
        onChange(image) {
            if (image) {
                this.$emit('change', image);
                // this.image = image

            } else {
                console.log('FileReader API not supported!')
            }
        }
    }
}
</script>


<style src="./PictureInput.css" lang="css"></style>
