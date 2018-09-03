@extends("layouts.master")

@section("content")
    <div class="container">
        <products-index
            title="{{ __('strings.title.new_products') }}"
            urladd="{{ route('new-products.create') }}"
            urlview="{{URL::to('new-products')}}/"
            urlfetch="{{ route('ajax.new-product.index') }}"
            imgurl="{{asset('/')}}"
        >
        </products-index>
    </div>
@endsection
