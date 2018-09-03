@extends("layouts.master")

@section("content")
    @include('inc.breadcrumb', [
        'breadcrumb_home'     => __('strings.title.new_products'),
        'breadcrumb_home_url' => route('new-products.index'),
        'breadcrumb_current'  => $newProduct->name,
    ])

    <div class="row justify-content-between mb-3">
        <div class="col-xs-12 col-md-12 col-lg-5 mr-xs-0 mr-lg-5">
            <h1 class="d-flex mb-5">
                {{ $newProduct->name }}
                @if (Auth::user()->isAdmin())
                    <a href="{{route('new-products.edit', $newProduct->id)}}"
                        target="new"
                        class="ml-2 d-flex align-items-center text-primary">
                        {!! svgIcon('icon-edit-circle', 'ic-42') !!}
                    </a>
                @endif
            </h1>

            <h6 class="mt-3 font-weight-bold">{{ __('strings.launch_date') }}</h6>
            <p class="mb-3">
                {{ \Carbon\Carbon::createFromFormat("Y-m-d", $newProduct->launch_date)->format("d M Y") }}
            </p>
            <p>
                {!! $newProduct->description !!}
            </p>
        </div>

        <div class="col-xs-12 col-md-12 col-lg-5 ml-5">
            <img src="{{ imgOrDummy($newProduct->img_description, 'product_placeholder.jpg') }}"
                class="img-fluid w-100 border">
        </div>
    </div>

    <div class="row justify-content-between mt-5 mb-3">
        <div class="col-xs-12 col-md-12 col-lg-5 mr-5">
            <img src="{{ imgOrDummy($newProduct->img_application, 'product_placeholder.jpg') }}"
                class="img-fluid border _w-100">
        </div>

        <div class="col-xs-12 col-md-12 col-lg-5 ml-5">
            <h3 class="mb-4 text-primary">{{ __('strings.application') }}</h3>
            <p>
                {!! $newProduct->application !!}
            </p>
        </div>
    </div>


    <hr class="mt-5">


    <h3 class="text-center text-primary my-5">{{ __('strings.title.sales_tools') }}</h3>


    <div class="row mb-5">
        @foreach ($newProduct->salesTools as $tool)
            <div class="col-xs-6 col-sm-6 col-md-4 col-xl-3 mb-4">
                <div class="card">
                    <a href="{{ $tool->file_name ?: $tool->video_url }}" target="new">
                        <div class="card-img-wrap">
                            <img src="{{ imgOrDummy($tool->image, 'product_placeholder.jpg') }}"
                                class="card-img-top img-fluid">
                            <div class="card-badge badge badge-pill badge-primary px-2">
                                {{ $tool->file_type }}
                            </div>
                            @if ($tool->video_url)
                                <div class="card-icon-video fa fa-play-circle"></div>
                            @endif
                        </div>
                        <div class="card-body bg-light py-3">
                            <p class="item-title">
                                {{ $tool->title }}
                            </p>
                            <h6 class="card-text text-primary">
                                {{ $tool->release_date }}
                            </h6>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{--<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/6.6.3/video.js"></script>--}}
@endsection
