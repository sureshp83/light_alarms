
/*
 |--------------------------------------------------------------------------
 | Custom Components
 |--------------------------------------------------------------------------
 */
Vue.component('search-autocomplete', require('./SearchAutocomplete/SearchAutocomplete.vue'));
Vue.component('vue-croppie', require('./VueCroppie/VueCroppie.vue'));
Vue.component('image-input', require('./ImageInput/ImageInput.vue'));
Vue.component('picture-input', require('./ImageInput/PictureInput.vue'));
Vue.component('show-password', require('./ShowPassword.vue'));


// Users
Vue.component('user-register', require('./User/user-register.js'));


// Agencies
Vue.component('agency-register', require('./Agency/agency-register.js'));
Vue.component('agency-ajax', require('./Agency/agency-ajax.vue'));
Vue.component('agency-single-agency', require('./Agency/agency-single-agency.vue'));

// Common components
Vue.component('items-index-actions', require('./Items/ItemsIndexActions.vue'));

// Product components
Vue.component('products-index', require('./Products/ProductsIndex.vue'));
Vue.component('products', require('./Products/Products.vue'));
Vue.component('product', require('./Products/Product.vue'));

// Training Modules
Vue.component('product-training-videos-index', require('./ProductTrainingVideos/ProductTrainingVideosIndex.vue'));
Vue.component('product-training-videos', require('./ProductTrainingVideos/ProductTrainingVideos.vue'));
Vue.component('product-training-video', require('./ProductTrainingVideos/ProductTrainingVideo.vue'));


// Elements <select>
Vue.component('agency-input-select', require('./SelectInput/AgencyInputSelect.vue'));
Vue.component('product-category-input-select', require('./SelectInput/ProductCategoryInputSelect.vue'));


// Custom Brochure Request
Vue.component('custom-brochure-request', require('./CustomBrochureRequest/CustomBrochureRequest.vue'));

//modal componenet
/*
Vue.component('modal', {
    name: 'modal'
})*/


