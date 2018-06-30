@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="ion ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.sms.edit.title') }}
    </span>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
        @include('partials.errors')
        <form name="SubscriberForm" class="form-vertical" role="form" method="POST" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>

            <div class="form-group">
                <label>{{ trans('forms.user.email') }}</label>
                <p>{{$subscriber->email}}</p>
            </div>

            <div class="form-group">
                <label for="sms-number">{{ trans('forms.user.sms_number') }}</label>
                <input type="text" class="form-control" name="sms-number" id="sms-number" value="{{$subscriber->sms_number}}" placeholder="{{ trans('forms.user.sms_number') }}">
            </div>

            <input type="hidden" name="sms-notify" value="0">
            <div class="form-group">
                <label for="sms-notify">{{ trans('dashboard.subscribers.sms.edit.notify') }}</label>
                <p><input name="sms-notify" type="checkbox" value="1" {{ $subscriber->sms_notify ? Binput::old('sms_notify', 'checked') : "" }}></p>
            </div>

            </fieldset>

            <div class="form-group">
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    <a class="btn btn-default" href="{{ cachet_route('dashboard.subscribers.sms') }}">{{ trans('forms.cancel') }}</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@stop