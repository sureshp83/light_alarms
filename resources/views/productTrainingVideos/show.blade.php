@extends("layouts.master")

@section("content")
    @include('inc.breadcrumb', [
        'breadcrumb_home'     => __('strings.title.product_training_videos'),
        'breadcrumb_home_url' => route('product-training-videos.index'),
        'breadcrumb_current'  => $productTrainingVideo->title,
    ])

    <div class="row mb-4">
        <div class="col mr-5">
            <h1 class="d-flex mb-5">
                {{ $productTrainingVideo->title }}
                @if (Auth::user()->isAdmin())
                    <a href="{{route('product-training-videos.edit', $productTrainingVideo->id)}}"
                        target="new"
                        class="ml-2 d-flex align-items-center text-primary">
                        {!! svgIcon('icon-edit-circle', 'ic-42') !!}
                    </a>
                @endif
            </h1>
            <p>
                {!! $productTrainingVideo->description !!}
            </p>
        </div>

        <div class="col ml-5">
            <div class="border">
                <img src="{{ imgOrDummy($productTrainingVideo->image, 'product_placeholder.jpg') }}" class="img-fluid w-100">
            </div>
        </div>
    </div>

{{--
    <h4 class="text-primary mt-5 mb-3">{{ __('strings.title.product_training_tools') }}</h4>
    <div class="row mb-5">
        @foreach ($productTrainingVideo->productTrainingTools as $tool)
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


    <h4 class="text-primary mt-5 mb-3">{{ __('strings.title.sales_tools') }}</h4>
    <div class="row mb-5">
        @foreach ($productTrainingVideo->salesTools as $tool)
            <div class="col-xs-6 col-sm-6 col-md-4 col-xl-3 mb-4">
                <div class="card">
                    <a href="{{ $tool->file_name ? asset($tool->file_name) : $tool->video_url }}" target="new">
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
--}}
@endsection
