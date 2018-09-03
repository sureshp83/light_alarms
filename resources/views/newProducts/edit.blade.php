@extends("layouts.master")

@section("content")
    {!! Form::model($newProduct,
    [
      "route"   => ['new-products.update', $newProduct->id],
      "method"  => "PUT",
      "enctype" => "multipart/form-data"
    ])!!}

    <picture-input
            :width="350"
            :height="350"
            input-name="image"
            prefill="{{asset('storage/'.$newProduct->img_description)}}">
    </picture-input>

    {{--<p>{{Form::file('image')}}</p>--}}
    <label>Product Name</label>
    <p>{{Form::text("name", $newProduct->name)}}</p>

    <label>Launch Date</label>
    <p>{{Form::date("launch_date", \Carbon\Carbon::createFromFormat("Y-m-d", $newProduct->launch_date))}}</p>

    <label>Key Benefits</label>

    <label>Application</label>
    <p>{{Form::textarea("application", $newProduct->application)}}</p>
    <p>{{Form::submit('Update')}}</p>
@endsection
