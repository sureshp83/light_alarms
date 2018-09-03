@extends("layouts.master")
@section("content")
    <h1>{{__("Create new Training Video")}}</h1>
    {!! Form::open(['route' => 'product-training-videos.store', "method"  => "POST", "enctype" => "multipart/form-data"]) !!}

    <picture-input
            :width="350"
            :height="350"
            input-name='banner_image'>
    </picture-input>

    <label>{{__("Training module name")}}</label>
    <p>{{Form::text("title")}}</p>

    <label>{{__("Video URL")}}</label>
    <p>{{Form::text("video_url")}}</p>
    <br>OR<br>
    <label>{{__("Choose Video file")}}</label>
    <p><input type="file" class="" name="video_file" id="video_file" accept="video/*"></p>

    <label>{{__("Description")}}</label>
    <p>{{Form::textarea("description")}}</p>

    <p>{{Form::submit('Save')}}</p>
    {!! Form::close() !!}
@endsection
