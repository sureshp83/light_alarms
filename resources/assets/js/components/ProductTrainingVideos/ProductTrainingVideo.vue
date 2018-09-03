<template>
    <div class="card">
        <a @click="showvideo()" href="javascript:void(0);"
            :title="item.title"
            class="item-link">
            <img
                class="card-img-top"
                :src="img(item)"
                :alt="item.title"
                />
            <div class="card-body bg-light pb-2">
                <h6 v-text="item.title"
                    class="item-title"
                ></h6>
            </div>
        </a>
        <div v-if="showModal" @close="showModal = false" class="modal-backdrop">
                        <div class="modal">
                            <div class="modal-dialog">
                              <div class="modal-header">
                                          <button type="button" class="btn-close" @click="close">x</button>
                              </div>
                              <div class="modal-body">

                              </div>
                              <div class="modal-footer">

                              </div>
                            </div>
                         </div>
                   </div>
    </div>

</template>

<script>
export default {
    name:'modal',
    props: ['urlview', 'item'],

    data() {
        return {showModal: false}
    },

    methods: {
        open() {
            this.$refs.item.click()
        },

        img(item) {
            if (!item.image) return '/img/placeholder.jpg'

            let _img = item.image.split('.')

            return '/storage/'+_img[0]+'-small.'+_img[1];
        },
        showvideo(){
          console.log('test');
          this.showModal=true
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
