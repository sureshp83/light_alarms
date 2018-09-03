<template>
    <div>
        <div class="row">
            <div
                v-for="product in products"
                class="col-xs-6 col-sm-6 col-md-4 col-xl-3 pl-0 mb-4"
            >
                <product
                    :key="product.id"
                    :product="product"
                    :urlview="urlview"
                    :imgurl="imgurl"
                >
                </product>
            </div>
        </div>

        <div class="row mt-3">
            <div v-if="loading === false && products.length === 0"
                class="mx-auto"
                cloak>
                no entries found
            </div>
            <button type="button"
                v-if="_offset > -1 && products.length > 0 || loading"
                class="btn btn-dark btn-lg mx-auto"
                :class="{disabled: loading}"
                @click="loadMore"
                >
                <i v-if="loading" class="mr-1 fa fa-btn fa-spinner fa-spin"></i>
                <i v-if="!loading" class="mr-1 fa fa-btn fa-chevron-down"></i>
                <span v-if="loading">Loading</span>
                <span v-if="!loading">Show more</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'urlview',
        'urlfetch',
        'imgurl'
    ],

    data() {
        return {
            params:  {
                offset:           0,    // -1 when reach the end of pagination
                pagesize:         12,   // pagination size
                product_category: 0,
            },
            products: [],
            loading:  false,
            error:    false,
        }
    },


    created() {
        this._offset = 0

        Bus.$on('LoadProducts', (data) => this.load(data))
    },


    methods: {
        load(data) {
            this.params.pagesize         = data.pagesize
            this.params.product_category = data.product_category

            this._offset  = 0     // reset pagination
            this.loading  = false
            this.products = []

            this.fetch()
        },
        loadMore() {
            this.fetch()
        },
        fetch() {
            // Skip if we've reached the end or is still loading
            if (this._offset < 0 || this.loading) {
                return;
            }

            this.params.offset = this._offset

            // Prepare the next query offset
            this._offset += this.params.pagesize
            this.error   = false
            this.loading = true

            axios.post(this.urlfetch, this.params)
                .then((res) => {
                    this.products.push.apply(this.products, res.data);

                    // Check if we have reached the end
                    if (res.data.length < this.params.pagesize) {
                        this._offset = -1
                    }

                    setTimeout(() => {
                        this.loading = false
                    }, 1000)
                })
                .catch(error => {
                    this.error   = true
                    this.loading = false
                });
        }
    }
}
</script>
