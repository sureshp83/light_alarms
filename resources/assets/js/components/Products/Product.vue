<template>
    <div class="card">
        <a :href="urlview+`${product.slug}`">
            <img
                class="card-img-top"
                v-bind:src="imgurl+img(product)"
                :alt="product.name"
                />
            <div class="card-body bg-light">
                <h6 class="item-title font-weight-bold pb-1"
                    v-text="product.name"
                ></h6>
                {{ product.launch_date }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    props: ['urlview', 'product','imgurl'],

    data() {
        return {}
    },

    methods: {
        open() {
            this.$refs.product.click()
        },

        img(item) {
            if (!item.img_description) return '/img/placeholder.jpg'

            let _img = item.img_description.split('.')

            return 'storage/'+_img[0]+'-small.'+_img[1];
        },
    }
}
</script>
