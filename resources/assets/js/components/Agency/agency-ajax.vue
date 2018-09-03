<template>
<div>
<div class="panel-heading clearfix">
    <a class="btn btn-link border-right" v-bind:class="firactive" :href="urlindex">
        {{ list_agencies_title }}
    </a>
    <a class="btn btn-link" v-bind:class="secactive" :href="urlawaiting">
                {{ awaiting_approvals_title }} <span class="badge">{{ awaiting_approvals_count }} </span>
        </a>

    <div class="pull-right">
        <a class="btn btn-sm text-primary" @click="multidelete()" href="javascript:void(0);">
            <i class="fa fa-trash" v-bind:class="{active:selected.length > 0}"></i>
        </a>

        <b-badge v-if="secactive" href="#" @click="approved()" variant="primary">
            {{ approve_title }}
        </b-badge>

    </div>
</div>

<div v-if="showModal" @close="showModal = false" class="modal-backdrop">
 <form ref="form" class="form-horizontal" @submit.prevent="submitMember">
    <div class="modal">
    <div class="modal-dialog">
      <div class="modal-header">
                  Select new agency manager
                  <a href="javascript:void(0);" class="btn-save badge-primary" v-bind:class="{active:selmem != 0}" @click="savechanges">SAVE CHANGES</a>
                  <button type="button" class="btn-close" @click="close">x</button>
      </div>
      <div class="modal-body">
             <b-form-group>
                 <table id="table_id" class="table _table-striped">
                         <thead>
                         <tr>
                             <th></th>
                             <th>TEAM MEMBER</th>
                             <th>PHONE</th>
                             <th>EXT.</th>
                             <th>EMAIL</th>
                         </tr>
                         </thead>
                         <tbody v-for="mem in members">
                            <tr>
                            <td><div class="Checkbox custom-checkbox"><input type="radio" :value="mem.id" id="mem.id" v-model="selmem"><div class="Checkbox-visible"></div></div></td>
                            <td><span class="mem-name">{{mem.name}}</span><br>{{mem.position}}</td>
                            <td>{{mem.phone}}</td>
                            <td>{{mem.phone_ext}}</td>
                            <td>{{mem.email}}</td>
                            </tr>
                         </tbody>
                 </table>
             </b-form-group>
              <div v-if="memloading === false && members.length === 0"
                   class="mx-auto"
                   cloak>
                   no entries found
               </div>
             <button type="button"
                   v-if="mem_offset > -1 && members.length > 0 || memloading"
                   class="btn btn-dark btn-lg mx-auto"
                   :class="{disabled: memloading}"
                   @click="loadMoreContacts"
                   >
                   <i v-if="memloading" class="mr-1 fa fa-btn fa-spinner fa-spin"></i>
                   <i v-if="!memloading" class="mr-1 fa fa-btn  fa-arrow-down"></i>
                   <span v-if="memloading">Loading</span>
                   <span v-if="!memloading">Show more contacts</span>
               </button>
      </div>
       <div class="modal-footer">

     </div>
     </div>
    </div>
    </form>
  </div>

<div class="panel-body">
<b-form-group>
    <table id="table_id" class="table _table-striped">
            <thead>
            <tr>
                <th><div class="Checkbox custom-checkbox"><input type="checkbox" v-model="toggleAll"><div class="Checkbox-visible"></div></div></th>
                <th>AGENCY</th>
                <th></th>
                <th>AGENCY MANAGER</th>
                <th>MANAGER CONTACT INFORMATION</th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="product in products">
                <tr>
                   <td>
                   <div class="Checkbox custom-checkbox">
                     <input type="checkbox" v-model="selected" :value="product.id" number />
                     <div class="Checkbox-visible"></div>
                   </div>
                    <!--input type="checkbox" v-model="selected" :value="product.id" number -->
                    </td>
                   <td><img
                       class="card-img-top"
                       v-bind:src="imgurl+img(product)"
                       :alt="product.name"
                       /></td>
                   <td>{{product.name}}<br>{{product.address}}<br>{{product.city}} {{product.state_province}} {{product.postal_code}}<br><br>{{product.phone}}<br>{{product.website}}</td>
                   <td>{{product.adminname}}<br>{{product.position}}</td>
                   <td>{{product.phone}} ext. {{product.phone_ext}}<br>{{product.email}}</td>
                   <td v-if="">

                       <a href="javascript:void(0);" id="show-modal" @click="loaddata(product)" class="btn btn-sm btn-default">
                           CHANGE ADMIN
                       </a>
                       <!--form style="display: inline-block;" :action="urldelete+'/'+product.id+'/destroy'" method="post">

                            <input type="hidden" name="_token" :value="csrftoken" />
                           <input type="hidden" name="_method" value="DELETE" />
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                       </form -->

                    </td>
                </tr>
            </tbody>
    </table>
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
  </b-form-group>
</div>
</div>
</template>

<script>

export default {
    props: ['imgurl','firactive','secactive','ishidden','urlfetch','urlindex','list_agencies_title','urlawaiting','awaiting_approvals_title','awaiting_approvals_count','approve_title','urlmdelete','urlapprove','urldelete','csrftoken','urlgetteam','urlsetmanager'],

    data() {
            return {
                params:  {
                    offset:           0,    // -1 when reach the end of pagination
                    pagesize:         10
                },
                mem_params:{
                    offset:        0,    // -1 when reach the end of pagination
                    pagesize:         4
                },
                products: [],
                loading:  false,
                memloading:false,
                error:    false,
                memerror:false,
                csrf: "",
                allSelected: false,
                selected: [],
                userIds: [],
                showModal:false,
                members:[],
                selmem:[],
                agency_id:'',
            }
        },
        created() {
                this._offset = 0
                this.mem_offset = 0
                Bus.$on('LoadProducts', (data) => this.load(data))
            },
        mounted() {
                this.load(this.params);
            },
     computed: {
        toggleAll :{
            get: function () {
               return this.products ? this.selected.length == this.products.length : false;
            },
            set:function (value){
                this.userIds = [];
                 var selected = [];
                 if (value) {
                     this.products.forEach(function (user) {
                         selected.push(user.id);
                     });
                     console.log(selected);
                 }
                this.selected = selected;
            }
        },

       },
     methods:{
         load(data) {

                    this.params.pagesize         = data.pagesize
                    this._offset  = 0     // reset pagination
                    this.loading  = false
                    this.products = []

                    this.fetch()
                },
                loadMore() {
                    this.fetch()
                },
                loadMoreContacts(){
                    this.memfetch()
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
                            this.products.push.apply(this.products, res.data.data);

                            // Check if we have reached the end
                            if (res.data.data.length < this.params.pagesize) {
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
                memfetch(){
                    // Skip if we've reached the end or is still loading
                    if (this.mem_offset < 0 || this.memloading) {
                        return;
                    }
                    this.mem_params.offset = this.mem_offset
                    // Prepare the next query offset
                    this.mem_offset += this.mem_params.pagesize
                    this.memerror   = false
                    this.memloading = true

                    axios.post(this.urlgetteam+'/'+this.agency_id,this.mem_params)
                         .then((res) => {
                         console.log(res);
                         this.members.push.apply(this.members, res.data);
                        // Check if we have reached the end
                        this.showModal=true;
                        if (res.data.length < this.mem_params.pagesize) {
                            this.mem_offset = -1
                        }
                        setTimeout(() => {
                            this.memloading = false
                        }, 1000)
                      })
                      .catch(error => {
                          this.memerror   = true
                          this.memloading = false
                      });

                },
                img(item) {

                    //let _img = item.img_description.split('.')

                    return 'storage/'+item.avatar;
                },
                approved(){
                    axios.post(this.urlapprove, this.selected)
                        .then((res) => {
                            swal({
                                title: '',
                                text: "All members have been approved.",
                                icon: this.imgurl+'/img/checked.png',
                                button:false,
                                timer: 1700,
                                successMode:true
                            })
                            this.load(this.params)
                            this.awaiting_approvals_count=this.awaiting_approvals_count-this.selected.length

                        })
                        .catch(error => {
                            this.error   = true
                            this.loading = false
                        });

                },
                multidelete(){
                    axios.post(this.urlmdelete, this.selected)
                        .then((res) => {
                            console.log(res);
                            this.awaiting_approvals_count=this.awaiting_approvals_count-this.selected.length
                            this.load(this.params)
                        })
                        .catch(error => {
                            this.error   = true
                            this.loading = false
                        });
                },
                loaddata(member){
                        this.selmem=''
                        this.mem_params.pagesize     = this.mem_params.pagesize
                        this.mem_offset  = 0     // reset pagination
                        this.memloading  = false
                        this.members = []
                        this.agency_id=member.id
                        this.memfetch()

                    /*this.agency_id=member.id;
                     axios.get(this.urlgetteam+'/'+member.id)
                     .then((res) => {
                         this.members=res.data;
                         console.log(this.members);
                         this.showModal=true;
                     })
                     .catch(error => {
                         this.error   = true
                         this.loading = false
                     });*/
                },
                close() {
                    this.showModal=false;
                    this.$emit('close');
                },
                check: function(e) {
                  if (e.target.checked) {
                    //this.selmem.push(e.target.value)
                  }
                },
                savechanges(){
                    axios.post(this.urlsetmanager, {'userid':this.selmem,'agency_id':this.agency_id})
                     .then((res) => {
                         this.showModal=false;
                         this.load(this.params)

                     })
                     .catch(error => {
                         this.error   = true
                         this.loading = false
                     });
                },

    }
};
</script>
<style src="./modalcss.css" lang="css"></style>