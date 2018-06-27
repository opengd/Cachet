@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="icon ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.incidents.incidents') }}
    </span>
    &gt; <small>{{ trans('dashboard.incidents.updates.title', ['incident' => $incident->name]) }}</small> &gt; <small>{{ trans('dashboard.incidents.updates.add.title') }}</small>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            @if(!$notificationsEnabled)
                <div class="alert alert-info" role="alert">
                    {{ trans('forms.incidents.notify_disabled') }}
                </div>
            @endif
            @include('partials.errors')
            <form class="form-vertical" name="IncidentUpdateForm" role="form" method="POST" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label for="incident-name">{{ trans('forms.incidents.status') }}</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" required {{ (int) Binput::old('status') === 1 ? 'checked' : null }}>
                            <i class="icon ion-flag"></i>
                            {{ trans('cachet.incidents.status')[1] }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2" required {{ (int) Binput::old('status') === 2 ? 'checked' : null }}>
                            <i class="icon ion-alert-circled"></i>
                            {{ trans('cachet.incidents.status')[2] }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="3" required {{ (int) Binput::old('status') === 3 ? 'checked' : null }}>
                            <i class="icon ion-eye"></i>
                            {{ trans('cachet.incidents.status')[3] }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="4" required {{ (int) Binput::old('status') === 4 ? 'checked' : null }}>
                            <i class="icon ion-checkmark"></i>
                            {{ trans('cachet.incidents.status')[4] }}
                        </label>
                    </div>
                    @if($incident->component)
                    <div class="form-group hidden" id="component-status">
                        <input type="hidden" name="component_id" value="{{ $incident->component->id }}">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="radio-items">
                                    @foreach(trans('cachet.components.status') as $statusID => $status)
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="component_status" value="{{ $statusID }}">
                                            {{ $status }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($incident->component)
                    <div class="form-group" id="component-status">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>{{ $incident->component->name }}</strong></div>
                            <div class="panel-body">
                                <div class="radio-items">
                                    @foreach(trans('cachet.components.status') as $statusID => $status)
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="component_status" value="{{ $statusID }}" {{ $incident->component->status == $statusID ? "checked='checked'" : "" }}>
                                            {{ $status }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>{{ trans('forms.incidents.message') }}</label>
                        <div class="markdown-control">
                            <textarea name="message" class="form-control autosize" rows="5" required>{{ Binput::old('message') }}</textarea>
                        </div>
                    </div>
                    @if($notifications_enabled)
                        <input type="hidden" name="notify" value="0">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="notify" value="1" checked="{{ Binput::old('notify', 'checked') }}">
                                {{ trans('forms.incidents.notify_subscribers') }}
                            </label>
                        </div>
                    @endif
                </fieldset>

                <input type="hidden" name="incident_id" value="{{ $incident->id }}">

                <div class="form-group">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                        <a class="btn btn-default" href="{{ cachet_route('dashboard.incidents') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
