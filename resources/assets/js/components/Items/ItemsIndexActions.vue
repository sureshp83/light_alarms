<!--
    Will emit an event on change, passing an object with filter options.
-->
<template>
    <div class="d-flex align-items-center justify-content-end mr-2">
        <label class="mb-0 mr-3">View</label>

        <div>
            <b-select
                size="lg"
                name="pagesize"
                v-model="actions.pagesize"
                @change="onChangePagesize"
            >
                <option :value="12">12 items</option>
                <option value="24">24</option>
                <option value="48">48</option>
            </b-select>
        </div>

        <div class="mx-2">
            <product-category-input-select
                id="sortby_product_category"
                name="sortby_product_category"
                size="lg"
                selected="actions.product_category"
                required="required"
                txtdefault="Filter by category"
                @change="onChangeCategory"
            >
            </product-category-input-select>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            actions: {
                pagesize:         12,
                product_category: 0,
            },
        }
    },

    created() {
        this.pagesize = this.pagesize
    },

    methods: {
        onChangePagesize(value) {
            this.actions.pagesize = value
            this.change();
        },

        onChangeCategory(category) {
            this.actions.product_category = category
            this.change();
        },

        change() {
            this.$emit('handler', this.actions);
        }
    }
}
</script>
