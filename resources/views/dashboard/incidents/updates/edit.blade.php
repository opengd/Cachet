@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="icon ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.incidents.incidents') }}
    </span>
    &gt; <small>{{ trans('dashboard.incidents.updates.title', ['incident' => $incident->name]) }}</small> &gt; <small>{{ trans('dashboard.incidents.updates.edit.title') }}</small>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            @if(!Config::get('setting.disable_notifications') && !$notificationsEnabled)
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
                            <input type="radio" name="status" value="1" required {{ ($update->status == 1) ? "checked='checked'" : "" }}>
                            <h4><span class="label label-danger"><i class="ion ion-flag"></i>
                            {{ trans('cachet.incidents.status')[1] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2" required {{ ($update->status == 2) ? "checked='checked'" : "" }}>
                            <h4><span class="label label-default" style="background-color: #f0ad4e;"><i class="ion ion-alert-circled"></i>
                            {{ trans('cachet.incidents.status')[2] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="3" required{{ ($update->status == 3) ? "checked='checked'" : "" }}>
                            <h4><span class="label label-info"><i class="ion ion-eye"></i>
                            {{ trans('cachet.incidents.status')[3] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="4" required {{ ($update->status == 4) ? "checked='checked'" : "" }}>
                            <h4><span class="label label-primary" style="background-color: #5cb85c;"><i class="ion ion-checkmark"></i>
                            {{ trans('cachet.incidents.status')[4] }}</span></h4>
                        </label>
                    </div>
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
                            <textarea name="message" class="form-control autosize" rows="5" required>{{ $update->message }}</textarea>
                        </div>
                    </div>
                </fieldset>

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
