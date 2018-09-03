<script>
import brochureProducts from './brochure_products.json'

export default {
    props: [
        'email',
        'agency_name',
        'agent_name',
        'agent_phone',
        'agent_address',
        'agent_city',
        'agent_state',
        'agent_zip',
    ],


    mixins: [
        brochureProducts,
    ],

    data() {
        return {
            client_name:  '',
            brand:        'Lightalarms',
            market:       'commercial',
            optional:     [],
            products:     [],
            api_url:      'http://australiancobra.canadaeast.cloudapp.azure.com/GenerateBrochureAPI',
            brands:       ['Lightalarms', 'Emergi-Lite', 'Lumacell', 'Ready-Lite'],
            markets:      ['commercial','industrial','architectural','institutional','hospitality','petroleum'],
            busy:         false,
            productsData: []
        }
    },


    created() {
        this.reload();
    },


    methods: {
        onSubmit() {
            this.busy = true

            let _payload = {
                brand:                   this.brand,
                market:                  this.market,
                product:                 this.products,
                optbrand:                this.optional,
                email:                   this.email,
                brand:                   this.brand,
                products:                this.products,
                includeNexusInformation: false,
                includeLedInformation:   false,
                clientName:              this.client_name,
                agencyName:              this.agency_name,
                agentName:               this.agent_name,
                agentPhoneNumber:        this.agent_phone,
                agentAddress:            this.agent_address,
                agentCity:               this.agent_city,
                agentZipCode:            this.agent_zip,
            };


            axios({
                    method: 'POST',
                    data: _payload,
                    url: this.api_url,
            })
                .then(res => {
console.log(res);
                    // let _data = res.data
                    // if (_data.hasOwnProperty('errors')) {
                    //     this.onFail(_data);
                    //     reject(_data);
                    // } else {
                    //     this.onSuccess(_data);
                    // }
                    this.busy = false
                })
                .catch(err => {
console.log(err);
                    this.busy = false
                })
        },
        onChangeBrand(brand) {
            this.brand = brand
            this.reload()
        },
        onChangeMarket(market) {
            this.market = market
            this.reload()
        },
        reload() {
            console.log('reload', this.brand, this.market);
            this.productsData = _.filter(brochureProducts, p => {
                return p.brand == this.brand && p.markets.includes(this.market);
            });
        }
    }
}
</script>
