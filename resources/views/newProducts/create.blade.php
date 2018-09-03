@extends("layouts.master")
@section("content")
    <h1>Create a new product</h1>
    {!! Form::open(['route' => 'new-products.store', "method"  => "POST", "enctype" => "multipart/form-data"]) !!}
    <picture-input
            :width="350"
            :height="350"
            input-name='image'>
    </picture-input>

    <label>Product Name</label>
    <p>{{Form::text("name")}}</p>

    <label>Launch Date</label>
    <p>{{Form::date("launch_date", \Carbon\Carbon::now())}}</p>

    <label>Key Benefits</label>

    <label>Application</label>
    <p>{{Form::textarea("application")}}</p>
    <p>{{Form::submit('Save')}}</p>

@endsection
