@extends("layouts.master")

@section("content")

    @php
        $agency = Auth::user()->agency();
    @endphp
<div class="row"><div class="col col-md-12 col-lg-10">
    {!! Form::open(['route' => 'marketing.display-board.post',
        "method"  => "POST",
        "enctype" => "multipart/form-data"
    ])!!}

        <h1>{{trans("strings.display_board.title")}}</h1>
        <div class="form-row">
            <div class="form-group col-xs-12 col-sm-10 col-md-10 text-secondary">
                {{ trans("strings.display_board.intro") }}
            </div>
        </div>


        <h6 class="border-bottom mt-3 pb-3 text-uppercase font-weight-bold">
            {{ __('strings.display_board.info') }}
        </h6>


        <div class="form-row pt-2 pb-3 pl-1">
            <div class="form-group col-md-8 pr-4">
                <img src="{{ asset('/img/display-board.jpg') }}" class="img-fluid">
                <small class="form-text text-muted">{{ __('strings.display_board.example') }}</small>
            </div>
            <div class="form-group col-md-4">
                <label>{{ __("strings.display_board.products_to_display") }}</label>
                @for($i = 1; $i <= 9; $i++)
                    {!! productSelect(
                            trans('strings.select_product').' '.$i.'...',
                            'product_ids['.$i.']',
                            'form-control-lg custom-select mb-2',
                            ''
                        )
                    !!}
                @endfor
            </div>
        </div>


        <div class="form-row mt-4">
            <div class="form-group col-md-8 pr-4">
                <label for="name_of_distributor">{{trans("strings.name_of_distributor")}}</label>
                <input type="text" class="form-control form-control-lg"
                    id="name_of_distributor"
                    name="name_of_distributor"
                    value="{{ $agency->name }}"
                    required="required">
            </div>
        </div>

        <div class="form-row pt-2">
            <div class="form-group col-md-5">
                <label for="flyer_type_id">{{trans("strings.display_board.size_display_board")}}</label>
                <select id="flyer_type_id" name="flyer_type_id" class="form-control-lg custom-select"
                    required="required">
                    <option value="">{{ __('strings.select_size_board') }}</option>
                    <option value="1" selected="selected">Size 2x2</option>
                    {{-- <option value="2">Size 3x2</option> --}}
                    {{-- <option value="3">Size 4x2</option> --}}
                </select>
            </div>
            <div class="form-group col-md-3 px-4">
                <label for="quantity">{{trans("strings.quantity_abv")}}</label>
                <input type="number" class="form-control form-control-lg"
                    id="quantity"
                    name="quantity"
                    min="1"
                    required="required">
            </div>
        </div>


        <div class="form-group pt-2 mb-5">
            {{--<vue-croppie
                    ref=croppieRef
                    customClass="class1"
                    :enableOrientation="true"
                    :mouseWheelZoom="false"
                    :viewport="{ width: 200, height: 200, type: 'circle' }"

            >
            </vue-croppie>--}}
            <file-upload
                id="distributor_logo"
                field="distributor_logo"
                txt_upload="{{ __('strings.upload_distributor_logo') }}"
                txt_choose="{{ __('strings.file_choose') }}"
                txt_remove="{{ __('strings.file_remove') }}"
            >
            </file-upload>
            <small class="form-text text-muted">{{ __('strings.upload_accepted') }}</small>
        </div>


        @include('marketingTools.inc.display_board__ship_to_form')


        <div class="form-group text-right">
            <button class="btn btn-lg btn-dark" type="submit" role="button">
                {{ __('strings.actions.send_request') }}
            </button>
        </div>
    {!! Form::close() !!}
</div></div>

@endsection