@extends("layouts.master")

@section("content")
    <div class="managevideo">
    <div class="container">
        <product-training-videos-index
            title="{{ __('strings.title.product_training_videos') }}"
            urladd="{{ route('product-training-videos.create') }}"
            urlview="{{ URL::to('product-training-videos') }}/"
            urlfetch="{{ route('ajax.product-training-videos.index') }}"
            imgurl="{{asset('/')}}"
        >
        </product-training-videos-index>
    </div>
    </div>
@endsection
