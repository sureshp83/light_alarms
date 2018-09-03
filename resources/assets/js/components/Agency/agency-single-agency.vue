<template>
<div>
<div class="panel-heading clearfix">
    <a class="btn btn-link border-right" v-bind:class="firactive" :href="urlindex">
        {{ list_agencies_title }}
    </a>
    <a class="btn btn-link" v-bind:class="secactive" :href="urlawaiting">
            {{ awaiting_approvals_title }} <span class="badge">{{ awaiting_approvals_count }}</span>
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
                  <button type="button" class="btn-close" @click="close">x</button>
      </div>
      <div class="modal-body">
                  <div class="row">
                     <div class="col">
                          <b-form-group
                              id="team_member"
                              label="Full Name"
                              label-for="team_member_name">
                              <b-form-input
                                  id="team_member_name"
                                  name="team_member_name"
                                  type="text"
                                  v-model="team_member_name"
                                  :value="team_member_name"
                                  required>
                              </b-form-input>
                          </b-form-group>
                     </div>
                     <div class="col">
                         <b-form-group
                             id="position"
                             label="Position"
                             label-for="position">
                             <b-form-input
                                 id="position"
                                 ref="position"
                                 name="position"
                                 type="text"
                                 v-model="position"
                                 :value="position"
                                 required>
                             </b-form-input>
                         </b-form-group>
                    </div>
                  </div>

                  <div class="row">
                     <div class="col">
                          <b-form-group
                              id="email"
                              label="Email"
                              label-for="email">
                              <b-form-input
                                  id="email"
                                  ref="email"
                                  name="email"
                                  type="text"
                                  v-model="email"
                                  :value="email"
                                  required>
                              </b-form-input>
                          </b-form-group>
                     </div>
                     <div class="col">
                         <b-form-group
                             id="phone"
                             label="Phone"
                             label-for="phone">
                             <b-form-input
                                 id="phone"
                                 ref="phone"
                                 name="phone"
                                 type="text"
                                 v-model="phone"
                                 :value="phone"
                                 required>
                             </b-form-input>
                         </b-form-group>
                    </div>
                    <div class="col">
                       <b-form-group
                           id="phone_ext"
                           label="Ext"
                           label-for="phone_ext">
                           <b-form-input
                               id="phone_ext"
                               ref="phone_ext"
                               name="phone_ext"
                               type="text"
                               v-model="phone_ext"
                               :value="phone_ext"
                               required>
                           </b-form-input>
                       </b-form-group>
                  </div>
                  </div>

                  <div class="row">
                    <div class="col">
                        <b-form-group
                       id="marketing_format"
                       label="Marketing Format"
                       label-for="marketing_format">
                       </b-form-group>
                       <div class="checkbox-inline">
                       <div class="Checkbox custom-checkbox">
                       <input type="checkbox" id="checkbox1" v-model="chkprint" @change=changechkp($event)>
                        <div class="Checkbox-visible"><span>print</span></div>
                       </div>
                       <div class="Checkbox custom-checkbox">
                      <input type="checkbox" id="checkbox2" v-model="chkemail"  @change=changechke($event)>
                       <div class="Checkbox-visible"><span>Email</span></div>
                      </div>
                      </div>

                    </div>
                  </div>
                </div>
       <div class="modal-footer">
       <slot name="footer">
         <button class="modal-default-button btn-save" >
           Save
         </button>
         <button class="modal-close btn-cancle" @click="close">
            Cancel
          </button>
       </slot>
     </div>
    </div>
    </div>
    </form>
  </div>

<div class="panel-body tab-responsive">
<b-form-group>
    <table id="table_id" class="table _table-striped">
            <thead>
            <tr>
                <th><div class="Checkbox custom-checkbox"><input type="checkbox" v-model="toggleAll"><div class="Checkbox-visible"></div></div></th>
                <th>TEAM MEMBER</th>
                <th>PHONE</th>
                <th>EXT.</th>
                <th>EMAIL</th>
                <th>MARKETNG FORMAT</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody v-for="product in products">
                <tr>
                   <td><div class="Checkbox custom-checkbox">
                    <input type="checkbox" v-model="selected" :value="product.id" number>
                    <div class="Checkbox-visible"></div>
                  </div>
                    </td>
                   <td>{{product.name}}<br>{{product.position}}</td>
                   <td>{{product.phone}}</td>
                   <td>{{product.ext}}</td>
                   <td>{{product.email}}</td>
                   <td>{{product.marketing_formate}}</td>
                   <td>
                       <a href="javascript:void(0);" id="show-modal" @click="loaddata(product)" class="btn btn-sm btn-default">
                           <i class="fa fa-pencil"></i>
                           <span class="edittext">EDIT</span>
                       </a>
                       <!-- use the modal component, pass in the prop -->

                       <!--form style="display: inline-block;" :action="urldelete+'/'+product.id+'/destroy'" method="post">

                            <input type="hidden" name="_token" :value="csrftoken" />
                           <input type="hidden" name="_method" value="DELETE" />
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                       </form -->
                    </td>
                </tr>
            </tbody>
    </table>
    <div class="row mt-3 mx-0">
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
    name: 'modal',
    props: ['firactive','secactive','ishidden','urlfetch','urlindex','list_agencies_title','urlawaiting','awaiting_approvals_title','awaiting_approvals_count','approve_title','urlmdelete','urlapprove','urldelete','csrftoken','urlupdate','imgurl'],

    data() {
            showModal:false;
            return {
                params:  {
                    offset:           0,    // -1 when reach the end of pagination
                    pagesize:         10
                },
                products: [],
                loading:  false,
                error:    false,
                allSelected: false,
                selected: [],
                userIds: [],
                showModal: false,
                id:'',
                team_member_name:'',
                position:'',
                phone:'',
                phone_ext:'',
                email:'',
                marketing_formate:'-',
                chkprint:false,
                chkemail:false
            }
        },
        created() {
                this._offset = 0
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
        }
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
                img(item) {

                    //let _img = item.img_description.split('.')

                    return './storage/'+item.avatar;
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
                     console.log(member);
                     this.id=member.id
                     this.team_member_name=member.name
                     this.position=member.position
                     this.email=member.email
                     this.phone=member.phone
                     this.phone_ext=member.ext
                     this.marketing_formate=member.marketing_formate
                     if(this.marketing_formate == "Print"){
                     this.chkprint=true
                     this.chkemail=false
                     }else if(this.marketing_formate == "Email"){
                     this.chkprint=false
                     this.chkemail=true
                     }else if(this.marketing_formate == "Print & Email"){
                     this.chkprint=true
                     this.chkemail=true
                     }else{
                     this.chkprint=false
                     this.chkemail=false
                     }
                     this.showModal=true;
                },
                changechkp(e){

                  if(e.target.checked){
                    this.chkprint=true
                  }else{
                    this.chkprint=false
                  }
                  console.log(this.chkprint)
                },
                changechke(e){
                  if(e.target.checked){
                  this.chkemail=true
                  }else{
                  this.chkemail=false
                  }
                },
                submitMember(){

                    var status="";
                    if(this.chkprint && this.chkprint!="false" && this.chkemail && this.chkemail!="false"){
                        status="Print & Email"
                    }else if(this.chkprint && this.chkprint!="false"){
                        status="Print"
                    }
                    else if(this.chkemail && this.chkemail!="false"){
                        status="Email"
                    }
                    var datas={
                           'id':this.id,
                           'name':this.$refs.form.team_member_name.value,
                           'position':this.$refs.form.position.value,
                           'email':this.$refs.form.email.value,
                           'phone':this.$refs.form.phone.value,
                           'phone_ext':this.$refs.form.phone_ext.value,
                           'marketing_formate':status
                        }
                    axios.put(this.urlupdate+'/'+datas.id+'/update',datas)
                        .then((res) => {
                            console.log(res);
                            this.showModal=false;
                            this.load(this.params)
                        })
                        .catch(error => {
                            this.error   = true
                            this.loading = false
                        });
                },
                close() {
                    this.showModal=false;
                    this.$emit('close');
                },
    }
};
</script>
<style src="./modalcss.css" lang="css"></style>