<script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>

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
<div class="content-wrapper" id="hpdpdpd">
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
                    @if($incidentUpdateTemplates->count() > 0)
                    <div class="form-group" id="gfg">
                        <label for="incident-template">{{ trans('forms.incidents.templates.template') }}</label>
                        <select class="form-control" name="template" onchange="onTemplateChange(this.value)">
                            <option selected></option>
                            @foreach($incidentUpdateTemplates as $tpl)
                            <option value="{{ $tpl->slug }}">{{ $tpl->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group" style="margin-bottom: 2em;">
                        <label for="incident-name">{{ trans('forms.incidents.status') }}</label><br>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" required {{ $incident->status === 1 ? 'checked' : null }}>
                            <h4 style="margin-bottom: 0px; margin-top: 5px;"><span class="label label-danger"><i class="ion ion-flag"></i>
                            {{ trans('cachet.incidents.status')[1] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2" required {{ $incident->status === 2 ? 'checked' : null }}>
                            <h4 style="margin-bottom: 0px; margin-top: 5px;"><span class="label label-default" style="background-color: #f0ad4e;"><i class="ion ion-alert-circled"></i>
                            {{ trans('cachet.incidents.status')[2] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="3" required {{ $incident->status === 3 ? 'checked' : null }}>
                            <h4 style="margin-bottom: 0px; margin-top: 5px;"><span class="label label-info"><i class="ion ion-eye"></i>
                            {{ trans('cachet.incidents.status')[3] }}</span></h4>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="4" required {{ $incident->status === 4 ? 'checked' : null }}>
                            <h4 style="margin-bottom: 0px; margin-top: 5px;"><span class="label label-primary" style="background-color: #5cb85c;"><i class="ion ion-checkmark"></i>
                            {{ trans('cachet.incidents.status')[4] }}</span></h4>
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
                    @if($notificationsEnabled)
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

<script>
function onTemplateChange(value) {
    axios.get('/dashboard/api/incidents/update/templates', {
        params: {
            slug: value
        }
    }).then(response => {
        $("[name='message']").val(response.data.template);
        $("[name='status'][value='" + response.data.status + "']").prop("checked",true);
    }).catch(response => {
        (new Cachet.Notifier()).notify('There was an error finding that template.');
    })
}
</script>

@stop
