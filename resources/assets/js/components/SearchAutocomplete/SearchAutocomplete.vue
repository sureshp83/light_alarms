<template lang="html">
    <div class="search-autocomplete">
        <div class="search-autocomplete__wrap">
            <div class="search-autocomplete__input_wrap"
                :class="focus ? 'search-autocomplete__focus' : ''">
                <input
                    class="form-control search-autocomplete__input"
                    type="text"
                    @input="search($event.target.value)"
                    @blur="on_blur"
                    @focus="on_focus"
                    placeholder="Search">
                <span class="form-control-feedback search-autocomplete__input-icon">
                    <svg class="icon">
                        <use xlink:href="#icon-search"></use>
                    </svg>
                </span>
            </div>

            <div v-if="loading" class="search-autocomplete__loading">
                loading...
            </div>

            <div v-if="loading" class="search-autocomplete__loading">
                loading...
            </div>

            <div class="search-autocomplete__results panel" v-if="isOpen && total > 0">
                <ul class="list-group list-group-flush"
                    v-for="(result_grp, result_grp_key) in results">
                    <li class="divider"
                        v-if="results.lenght > 1">
                         <strong>{{result_grp_key}}</strong>
                    </li>
                    <li class="py-2" v-for="(result, key) in result_grp">
                        <a v-bind:href="pagelinkurl +'/'+ key.replace(/\s+/g, '-').toLowerCase()" v-text="result"></a>
                    </li>
                    <li class="py-0 text-secondary text-lowercase small"
                        v-if="total === totalmax"
                    >
                        + <span v-text="totalmax"></span> hits found...
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
var csrf_token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
export default {
    props: ['searchurl','pagelinkurl'],
    data() {
        return {
            total:    0,
            totalmax: 10,
            results:  [],
            focus:    false,
            isOpen:   false,
            loading:  false,
            _timeout: null
        }
    },
    methods: {
        search($query) {
            this.loading = true
            this.results = []
            this.isOpen  = false
            this.total   = 0

            clearTimeout(this._timeout)
            this._timeout = setTimeout(() => {
                this.fetch($query)
            }, 300);
        },
        fetch($query) {
            this.total   = 0
            this.results = []
            this.isOpen  = true
            this.loading = false
            console.log(this.searchurl)
            axios.post(this.searchurl, { _token: csrf_token,q: $query })
                .then((res) => {
                    this.total   = res.data.total
                    this.results = res.data.hits
                    this.isOpen  = true
                    this.loading = false
                })
                .catch(res => {
                    swal({
                        title: 'Error searching...',
                        text: res.message,
                        icon: "warning",
                        dangerMode: true,
                    })
                    this.loading = false
                });
        },

        on_blur() {
            this.closeResultsPanel()
        },

        on_focus() {
            this.focus  = true
            this.isOpen = this.total > 0
        },

        closeResultsPanel(delay = 200) {
            setTimeout(() => {
                this.isOpen = false
                this.focus  = false
            }, delay);
        },

        // Implement highlight searched keyword
        highlight(text) {
            return text.replace(
                new RegExp(this.results, 'gi'),
                '<span class="highlighted">$&</span>'
            );
        }
    }
}
</script>
