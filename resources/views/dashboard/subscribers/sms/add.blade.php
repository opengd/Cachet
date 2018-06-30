@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="ion ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.sms.add.title') }}
    </span>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
        @include('partials.errors')
        <form name="SubscriberForm" class="form-vertical" role="form" action="{{ cachet_route('dashboard.subscribers.sms.add', [], 'post') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
            @if($subscribers->count() > 0)
                <div class="form-group">
                    <label for="subscribers">{{ trans('dashboard.subscribers.subscribers') }}</label>
                    <select class="form-control" name="subscribers">
                        <option selected></option>
                        @foreach($subscribers as $subscriber)
                        <option value="{{ $subscriber->email }}">{{ $subscriber->email }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label for="sms-number">{{ trans('forms.user.sms_number') }}</label>
                <input type="text" class="form-control" name="sms-number" id="sms-number" required placeholder="{{ trans('forms.user.sms_number') }}">
            </div>

            <input type="hidden" name="sms-notify" value="0">
            <div class="form-group">
                <label for="sms-notify">{{ trans('dashboard.subscribers.sms.add.notify') }}</label>
                <p><input name="sms-notify" type="checkbox" value="1" checked="{{ Binput::old('sms_notify', 'checked') }}"></p>
            </div>

            </fieldset>

            <div class="form-group">
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">{{ trans('forms.add') }}</button>
                    <a class="btn btn-default" href="{{ cachet_route('dashboard.subscribers.sms') }}">{{ trans('forms.cancel') }}</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@stop