<template>
    <div>
        <div class="row">
            <div
                v-for="item in items"
                class="col-xs-6 col-sm-6 col-md-4 col-xl-3 pl-0 mb-4"
            >
                <div class="card-deck">
                    <div class="card">
                            <a @click="showvideo(item.slug)" href="javascript:void(0);"
                                :title="item.title"
                                class="item-link">
                                <img
                                    class="card-img-top"
                                    v-bind:src="imgurl+img(item)"
                                    :alt="item.title"
                                    />
                                <div class="card-body bg-light pb-2">
                                    <h6 v-text="item.title"
                                        class="item-title"
                                    ></h6>
                                </div>
                            </a>
                     </div>

                </div>
            </div>
        </div>

         <div v-if="showModal" @close="showModal = false" class="modal-backdrop">
                    <div class="modal">
                        <div class="modal-dialog">
                          <div class="modal-header">

                            <button type="button" class="btn-close" @click="close">x</button>
                          </div>
                          <div class="modal-body">

                          <iframe width="740" height="350" frameborder="2" allowfullscreen
                          v-bind:src="videourl">
                          </iframe>
                          </div>

                        </div>
                     </div>
                 </div>

        <div class="row mt-3">
            <div v-if="loading === false && items.length === 0"
                class="mx-auto"
                cloak>
                no entries found
            </div>
            <button type="button"
                v-if="_offset > -1 && items.length > 0 || loading"
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
    name:'modal',
    props: [
        'urlview',
        'urlfetch',
        'imgurl',
    ],

    data() {
        return {
            showModal: false,
            params:  {
                offset:   0,    // -1 when reach the end of pagination
                pagesize: 12,   // pagination size
            },
            items: [],
            loading:  false,
            error:    false,
            videourl:'',
        }
    },


    created() {
        this._offset = 0

        Bus.$on('LoadProductTrainingVideos', (data) => this.load(data))
    },


    methods: {
        load(data) {
            this.params.pagesize = data.pagesize

            this._offset = 0     // reset pagination
            this.loading = false
            this.items   = []

            this.fetch()
        },
        loadMore() {
            this.fetch()
        },
        img(item) {
            if (!item.image) return '/img/placeholder.jpg'

            let _img = item.image.split('.')

            return 'storage/'+_img[0]+'-small.'+_img[1];
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
                    this.items.push.apply(this.items, res.data);

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
        },
        showvideo(slug){
                axios.get(this.urlview+slug)
                    .then((res) => {
                        console.log(res.data.video_url);
                        if(res.data.video_url.match(/demo/g)){
                          this.videourl="storage/"+res.data.video_url
                        }else{
                        this.videourl=res.data.video_url
                        }
                        console.log(this.videourl);
                        this.showModal=true
                    })
                   .catch(error => {
                       this.error   = true
                       this.loading = false
                   });

                },
                close(){
                  console.log('fff');
                  this.showModal=false
                  this.$emit('close');
                },
    }
}
</script>
<style src="./modalcss.css" lang="css"></style>
