@if (Session::has('caffeinated.flash.message'))
    <b-alert
        variant="{{ Session::get('caffeinated.flash.level') }}"
        class="pl-3 py-2"
        show="true"
        dismissible
    >{{ Session::get('caffeinated.flash.message') }}</b-alert>
@endif
