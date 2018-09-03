@extends('layouts.master')

@section('page_title')
    {{ __('strings.title.agencies') }}
@endsection

@section('content')
  <div class="managemembers">
    <div class="">
        <div class="row">
            <div class="col-4 agency-sidebar-main ">
                <div class="agency-sidebar">
                    <div class="agency-image">
                        <img class="img-fluid" src="{{asset('storage/'.$agencies[0]->avatar)}}">
                    </div>
                    <div class="agencybgcolor">
                    <div class="agency-content">
                        <a href="#" target="new" class="ml-2 d-flex align-items-center text-primary"><svg class="icon ic-42"><use xlink:href="#icon-edit-circle"></use></svg></a>
                        <h6 class="agency-title"> manager information</h6>
                        <p>The address shown is where printed literature will be sent by default.
                        </p>
                        <label clas="agency-subtitle">
                            agency manager
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->admin->name}}
                        </p>
                        <label clas="agency-subtitle">
                            email
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->admin->email}}
                        </p>
                        <label clas="agency-subtitle">
                            phone number
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->admin->phone}}
                        </p>
                        <div class="agency-checkboxpart">
                            <label clas="agency-subtitle">
                                marketing material <br> preference
                            </label>
                            <div class="Checkbox custom-checkbox">
                                <input type="checkbox" <?php echo ($agencies[0]->admin->marketing_formate == 'Print' || $agencies[0]->admin->marketing_formate == 'Print & Email')?'checked=checked':''; ?>>
                                <div class="Checkbox-visible"><span>print</span></div>
                            </div>
                            <div class="Checkbox custom-checkbox">
                                <input type="checkbox" <?php echo ($agencies[0]->admin->marketing_formate == 'Email' || $agencies[0]->admin->marketing_formate == 'Print & Email')?'checked=checked':''; ?> >
                                <div class="Checkbox-visible"><span>email</span></div>
                            </div>



                            <hr>
                        </div>
                    </div>
                    <div class="agency-content information">
                        <h6 class="agency-title"> Agency information</h6>
                        <label clas="agency-subtitle">
                            agency
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->name}}
                        </p>
                        <label clas="agency-subtitle">
                            phone number
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->phone}}
                        </p>
                        <label clas="agency-subtitle">
                            address
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->address}}, <br>
                            {{$agencies[0]->city}} , {{$agencies[0]->state_province}} {{$agencies[0]->postal_code}}
                        </p>
                        <label clas="agency-subtitle">
                            website
                        </label>
                        <p clas="agency-subtitle">
                            {{$agencies[0]->website}}
                        </p>
                    </div>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="panel panel-default">
                    <agency-single-agency @if(Request::Segment(2)=='awaiting') urlfetch="{{ URL::to('agencies/ajaxawaiting') }}" @else urlfetch="{{ URL::to('agencies/ajaxindex') }}" @endif
                    urlindex="{{route('agencies.index')}}"
                                 list_agencies_title="{{ __('strings.single_agency.list_agencies') }}"
                                 urlawaiting="{{route('agencies.awaiting')}}"
                                 awaiting_approvals_title="{{ __('strings.agencies.awaiting_approvals') }}" awaiting_approvals_count="{{isset($awaiting_count)?$awaiting_count:""}}"
                                 @if(Request::Segment(2) == "awaiting") approve_title="{{ __('strings.actions.approve') }}" urlapprove="{{URL::to('agencies/approved')}}" ishidden="false" firactive="" secactive="active" @else ishidden="true" secactive="" firactive="active" @endif
                                 urlmdelete="{{URL::to('agencies/deletemultiple')}}"
                                 urldelete="{{URL::to('agencies')}}"
                                 urlupdate="{{URL::to('agencies')}}"
                                 csrftoken="{{csrf_token()}}"
                                 imgurl="{{asset('/')}}"
                    >
                </agency-single-agency>

                </div>
            </div>
        </div>
    </div>
  </div>
@endsection