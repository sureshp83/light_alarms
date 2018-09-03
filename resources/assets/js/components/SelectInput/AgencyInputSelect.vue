<template>
    <div>
        <b-select
            :id="id"
            :name="name"
            :options.sync="options"
            :size="size"
            v-model="selected"
            @input="$emit('change', selected)"
            :required="required"
            >
            <template slot="first">
                <option value=""
                    v-text="'-- '+txtdefault+' --'"
                    disabled>
                </option>
            </template>
        </b-select>
    </div>
</template>

<script>
export default {
    props: [
        'id',
        'name',
        'size',
        'required',
        'txtdefault',
    ],


    data() {
        return {
            options:  [],
            selected: '',
        }
    },


    created() {
        Bus.$on('AgencyInputSelectAppend', (id, value) => this.append(id, value))
        Bus.$on('AgencyInputSelectRefresh', (selectLast) => this.fetch(selectLast))
    },


    mounted() {
        this.fetch()
    },


    methods: {
        fetch(selectLast = false) {
            this.options = []

            axios.get('/agencies/indexselect')
                .then((res) => {
                    this.options = res.data

                    if (selectLast) this._selectLast()
                })
                .catch(res => {
                    console.log('Error loading Agencies...')
                });
        },


        append(id, value, select = true) {
            Vue.set(this.options, id, value)

            if (select) {
                this.selected = id
                this.$emit('change', this.selected)
            }
        },


        _selectLast() {
            let _total = _.size(this.options)

            if (_total > 0) {
                this.selected = Object.keys(this.options)[_total-1]
            }
        },
    }
}
</script>
