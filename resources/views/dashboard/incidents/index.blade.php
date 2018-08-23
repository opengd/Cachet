@extends('layout.dashboard')

@section('content')
<div class="content-panel">
    @includeWhen(isset($subMenu), 'dashboard.partials.sub-sidebar')
    <div class="content-wrapper">
        <div class="header sub-header">
            <span class="uppercase">
                <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.incidents.incidents') }}
            </span>
            <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.incidents.create') }}">
                {{ trans('dashboard.incidents.add.title') }}
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                @if($ongoingIncidents->count() > 0)
                <p class="lead">{!! trans_choice('dashboard.incidents.ongoing', $ongoingIncidents->count(), ['count' => $ongoingIncidents->count()]) !!}</p>
                <div class="striped-list" style="margin-bottom: 3em;">
                @foreach($ongoingIncidents as $incident)
                <div class="row striped-list-item">
                        <div class="col-xs-6">
                            @if($incident->status == 1)
                            <span class="label label-danger"><i class="ion ion-flag"></i>
                            {{ trans('cachet.incidents.status')[1] }}</span>
                            @elseif($incident->status == 2)
                            <span class="label label-default" style="background-color: #f0ad4e;"><i class="ion ion-alert-circled"></i>
                            {{ trans('cachet.incidents.status')[2] }}</span>
                            @elseif($incident->status == 3)
                            <span class="label label-info"><i class="ion ion-eye"></i>
                            {{ trans('cachet.incidents.status')[3] }}</span>
                            @endif
                            <strong><a style="color: black" href="{{ cachet_route('dashboard.incidents.updates', [$incident->id]) }}">{{ $incident->name }}</a></strong> <span class="badge badge-info" style="background-color: #5bc0de;">{{ trans_choice('dashboard.incidents.updates.count', $incident->updates()->count(), ['count' => $incident->updates()->count()]) }}</span>
                            @if($incident->message)
                            <p>{{ Str::words($incident->message, 5) }}</p>
                            @endif
                            @if($incident->ticket && filter_var($incident->ticket, FILTER_VALIDATE_URL))
                            <p><span><a href="{{ $incident->ticket }}" target="_blank">{{ basename(parse_url($incident->ticket, PHP_URL_PATH)) }}</a></span></p>
                            @elseif($incident->ticket)
                            <p><span>{{ Str::words($incident->ticket)}}</span></p>
                            @endif                     

                            @if ($incident->user)
                            <p><small>&mdash; {{ trans('dashboard.incidents.reported_by', ['user' => $incident->user->username]) }} at {{ $incident->created_at }}</small></p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ cachet_route('dashboard.incidents.updates', [$incident->id]) }}" class="btn btn-info">{{ trans('forms.manage_updates') }}</a>
                            <a href="{{ cachet_route('dashboard.incidents.edit', [$incident->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="{{ cachet_route('dashboard.incidents.delete', [$incident->id], 'delete') }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                @endforeach
                </div>
                @endif
                @if($fixedIncidents->count() > 0)
                <p class="lead">{!! trans_choice('dashboard.incidents.past', $fixedIncidents->count(), ['count' => $fixedIncidents->count()]) !!}</p>
                
                <div class="striped-list">
                    @foreach($fixedIncidents as $incident)
                    <div class="row striped-list-item">
                        <div class="col-xs-6">
                            @if($incident->status == 1)
                            <span class="label label-danger"><i class="ion ion-flag"></i>
                            {{ trans('cachet.incidents.status')[1] }}</span>
                            @elseif($incident->status == 2)
                            <span class="label label-default" style="background-color: #f0ad4e;"><i class="ion ion-alert-circled"></i>
                            {{ trans('cachet.incidents.status')[2] }}</span>
                            @elseif($incident->status == 3)
                            <span class="label label-info"><i class="ion ion-eye"></i>
                            {{ trans('cachet.incidents.status')[3] }}</span>
                            @elseif($incident->status == 4)
                            <span class="label label-primary" style="background-color: #5cb85c;"><i class="ion ion-checkmark"></i>
                            {{ trans('cachet.incidents.status')[4] }}</span>
                            @endif
                            <strong><a style="color: black" href="{{ cachet_route('dashboard.incidents.updates', [$incident->id]) }}">{{ $incident->name }}</a></strong> <span class="badge badge-info" style="background-color: #5bc0de;">{{ trans_choice('dashboard.incidents.updates.count', $incident->updates()->count(), ['count' => $incident->updates()->count()]) }}</span>
                            @if($incident->message)
                            <p>{{ Str::words($incident->message, 5) }}</p>
                            @endif
                            @if($incident->ticket && filter_var($incident->ticket, FILTER_VALIDATE_URL))
                            <p><span><a href="{{ $incident->ticket }}" target="_blank">{{ basename(parse_url($incident->ticket, PHP_URL_PATH)) }}</a></span></p>
                            @elseif($incident->ticket)
                            <p><span>{{ Str::words($incident->ticket)}}</span></p>
                            @endif                     

                            @if ($incident->user)
                            <p><small>&mdash; {{ trans('dashboard.incidents.reported_by', ['user' => $incident->user->username]) }} at {{ $incident->created_at }}</small></p>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ cachet_route('dashboard.incidents.updates', [$incident->id]) }}" class="btn btn-info">{{ trans('forms.manage_updates') }}</a>
                            <a href="{{ cachet_route('dashboard.incidents.edit', [$incident->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="{{ cachet_route('dashboard.incidents.delete', [$incident->id], 'delete') }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @if($ongoingIncidents->count() == 0 && $fixedIncidents->count() == 0)
                <p class="lead">{!! trans_choice('dashboard.incidents.logged', 0, ['count' => 0]) !!}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@stop
