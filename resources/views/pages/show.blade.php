@extends("layouts.master")

@section('page_title')
    {{ $page->title }}
@endsection

@section('meta_description')
    {{ $page->meta_description }}
@endsection

@section("content")
    <div class="row mb-5">
        <h1>{{$page->title}}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xl-8">
            {!! $page->body !!}
        </div>
    </div>
@endsection
