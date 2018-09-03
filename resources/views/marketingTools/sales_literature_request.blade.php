@extends("layouts.master")

@section("content")
    @php
        $agency = Auth::user()->agency();
    @endphp
<div class="row">
    <div class="col col-md-12 col-lg-10">
    {!! Form::open(['route' => 'marketing.sales-literature.post',
        "method"  => "POST",
    ])!!}

        <h1>{{trans("strings.sales_literature.title")}}</h1>
        <div class="form-row mb-2">
            <div class="form-group col-xs-12 col-sm-10 col-md-10 text-secondary">
                {{ trans("strings.sales_literature.intro") }}
            </div>
        </div>


        <h6 class="border-bottom mt-3 pb-3 text-uppercase font-weight-bold">
            {{ __('strings.sales_literature.literature') }}
        </h6>


        <div class="row my-4">
            <div class="col-md-8">
                <div class="mb-3">{{ __('strings.sales_literature.select_your_literatures') }}</div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-catalog',
                            'name' => 'Full line Catalog',
                            'img'  => 'sales-literature-lightalarms-catalog.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-chicago',
                            'name' => 'Chicago Offering',
                            'img'  => 'sales-literature-lightalarms-chicago.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-LED',
                            'name' => 'LED Family Series',
                            'img'  => 'sales-literature-lightalarms-LED.jpg'
                        ])
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-nsf',
                            'name' => 'NSF Certified for Food Preparation and Cold Storage Applications',
                            'img'  => 'sales-literature-lightalarms-nsf.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-nyc',
                            'name' => 'NYC Offering',
                            'img'  => 'sales-literature-lightalarms-nyc.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'   => 'lightalarms-sp',
                            'name' => 'SP Series High-Performance Industrial Emergency LED Lighting',
                            'img'  => 'sales-literature-lightalarms-sp.jpg'
                        ])
                    </div>
                </div>
{{--
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'  => 'literature_07',
                            'img' => 'display-board.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'  => 'literature_08',
                            'img' => 'display-board.jpg'
                        ])
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('marketingTools.inc.btn_literature', [
                            'id'  => 'literature_09',
                            'img' => 'display-board.jpg'
                        ])
                    </div>
                </div>
 --}}
            </div>
            <div class="col-md-4 pl-5">
                <div class="form-group">
                    <label for="quantity">{{trans("strings.quantity_abv")}}</label>
                    <input type="number" class="form-control form-control-lg"
                        id="quantity"
                        name="quantity"
                        min="1"
                        value="{{ old('quantity') }}"
                        required="required">
                </div>

                <div class="form-group">
                    <label for="part_number">{{trans("strings.sales_literature.part_number")}}</label>
                    <input type="text" class="form-control form-control-lg"
                        id="part_number"
                        name="part_number"
                        value="{{ old('part_number') }}"
                        required="required">
                </div>
            </div>
        </div>


        @include('marketingTools.inc.ship_to_form')


        <div class="form-group text-right">
            <button class="btn btn-lg btn-dark" type="submit" role="button">
                {{ __('strings.actions.send_request') }}
            </button>
        </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection
