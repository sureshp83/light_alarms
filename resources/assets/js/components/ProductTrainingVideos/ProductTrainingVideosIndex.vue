<template>
    <div>
        <div class="row mb-5">
            <h1 class="d-flex">
                {{ title }}
                <a :href="urladd"
                    target="new"
                    class="ml-2 d-flex align-items-center">
                    <svg class="icon ic-42">
                        <use xlink:href="#icon-plus-circle"></use>
                    </svg>
                </a>
            </h1>
        </div>

        <product-training-videos
            :urlview="urlview"
            :urlfetch="urlfetch"
            :imgurl="imgurl"
        >
        </product-training-videos>
    </div>
</template>

<script>
export default {
    props: [
        'title',
        'urladd',
        'urlview',
        'urlfetch',
        'imgurl'
    ],


    data() {
        return {
            actions: {
                pagesize: 12,
            },
        }
    },


    mounted() {
        this.load(this.actions);
    },


    methods: {
        load(actions) {
            Bus.$emit('LoadProductTrainingVideos', actions);
        }
    }
}
</script>
