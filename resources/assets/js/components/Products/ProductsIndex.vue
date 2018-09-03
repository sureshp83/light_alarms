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
            <div class="ml-auto">
                <items-index-actions
                    @handler="load"
                >
                </items-index-actions>
            </div>
        </div>

        <products
            :urlview="urlview"
            :urlfetch="urlfetch"
            :imgurl="imgurl"
        >
        </products>
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
                pagesize:         12,
                product_category: 0,
            },
        }
    },


    mounted() {
        this.load(this.actions);
    },


    methods: {
        load(actions) {
            Bus.$emit('LoadProducts', actions);
        }
    }
}
</script>
