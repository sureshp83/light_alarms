@extends("layouts.master")
@section("content")
    {!! Form::model($productTrainingVideo,
        [
          "route"   => ['product-training-videos.update', $productTrainingVideo],
          "method"  => "PUT",
          "enctype" => "multipart/form-data"
        ])
    !!}
    <h1>{{__("Edit training module")}}</h1>
    <picture-input
            :width="350"
            :height="350"
            input-name='banner_image'
            prefill="{{asset('storage/'.$productTrainingVideo->image)}}">
    </picture-input>

    <label>{{__("Training module name")}}</label>
    <p>{{Form::text("title")}}</p>

    <label>{{__("Video URL")}}</label>
    <p>{{Form::text("video_url")}}</p>

    <label>{{__("Description")}}</label>
    <p>{{Form::textarea("description")}}</p>

    <p>{{Form::submit('Update')}}</p>
    {!! Form::close() !!}
@endsection