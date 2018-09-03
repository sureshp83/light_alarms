@extends('layouts.master')

@section('page_title')
    {{ __('strings.title.agencies') }}
@endsection

@section('content')
    <div class="manageagency">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-md-offset-2">
                <div class="panel panel-default">
                  <agency-ajax @if(Request::Segment(2)=='awaiting') urlfetch="{{ URL::to('agencies/ajaxawaiting') }}" @else urlfetch="{{ URL::to('agencies/ajaxindex') }}" @endif
                    urlindex="{{route('agencies.index')}}"
                    list_agencies_title="{{ __('strings.agencies.list_agencies') }}"
                    urlawaiting="{{route('agencies.awaiting')}}"
                    awaiting_approvals_title="{{ __('strings.agencies.awaiting_approvals') }}" awaiting_approvals_count="{{($awaiting_count)?$awaiting_count:""}}"
                    @if(Request::Segment(2) == "awaiting") approve_title="{{ __('strings.actions.approve') }}" urlapprove="{{URL::to('agencies/approved')}}" ishidden="false" firactive="" secactive="active" @else ishidden="true" secactive="" firactive="active" @endif
                    urlmdelete="{{URL::to('agencies/deletemultiple')}}"
                    urldelete="{{URL::to('agencies')}}"
                    urlgetteam="{{URL::to('agencies/getteam')}}"
                    urlsetmanager="{{URL::to('agencies/setmanager')}}"
                    csrftoken="{{csrf_token()}}"
                    imgurl="{{asset('/')}}"
                  >
                    {{--<div class="panel-heading clearfix">
                        <a class="btn btn-link active border-right" href="{{route('agencies.index')}}">
                            {{ __('strings.agencies.list_agencies') }}
                        </a>
                        <a class="btn btn-link" href="{{route('agencies.awaiting')}}">
                            {{ __('strings.agencies.awaiting_approvals') }} {{isset($awaiting_count)?$awaiting_count:""}}
                        </a>
                        <div class="pull-right">
                            <a class="btn btn-sm text-primary" href="#">
                                <i class="fa fa-trash"></i>
                            </a>
                            @if(Request::Segment(2) == "awaiting")
                            <b-badge href="#" @click="approved()" variant="primary">
                                {{ __('strings.actions.approve') }}
                            </b-badge>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">



                        {{--<b-form-group>
                        <table id="table_id" class="table _table-striped">
                            <thead>
                            <tr>
                                <td><b-check
                                            id="selectAll"
                                            @change="toggleAll"
                                    ></b-check>
                                </td>
                                <th>AGENCY</th>
                                <th>AGENCY MANAGER</th>
                                <th>MANAGER CONTACT INFORMATION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agencies as $agency)
                                @php
                                    $adminName  = $agency->admin ? $agency->admin->name : '-';
                                    $adminPosition  = $agency->admin ? $agency->admin->position : '-';
                                    $adminPhone = $agency->admin ? $agency->admin->phone : '-';
                                    $adminEmail= $agency->admin ? $agency->admin->email : '-';
                                @endphp

                                <tr>
                                    <td><b-check
                                                id="{{$agency->id}}"
                                                name="{{$agency->id}}"
                                        ></b-check>
                                    </td>
                                    <td><img src="{{asset('storage/'.$agency->avatar)}}"></td>
                                    <td>{{$agency->name}}</td>
                                    <td>{{ $adminName }}<br>{{ $adminPosition }}</td>
                                    <td>{{ $adminPhone }}<br>{{$adminEmail}}</td>

                                    <td>
                                        @if(auth()->user()->isAdmin() || auth()->user()->isAgencyAdmin())
                                            <a href="{{route('agencies.edit', $agency)}}" class="btn btn-sm btn-default">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form style="display: inline-block;" action="{{route('agencies.destroy', $agency)}}" method="post">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </b-form-group>--}}

                </agency-ajax>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

