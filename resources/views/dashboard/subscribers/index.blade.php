@extends('layout.dashboard')

@section('content')
<div class="header fixed">
    <div class="sidebar-toggler visible-xs">
        <i class="ion ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.subscribers') }}
    </span>
    @if($current_user->isAdmin && $enable_subscribers)
    <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.subscribers.create') }}">
        {{ trans('dashboard.subscribers.add.title') }}
    </a>
    @endif
    <div class="clearfix"></div>
</div>
<div class="content-wrapper header-fixed">
    <div class="row">
        <div class="col-sm-12">
            <p class="lead">
                @if($enable_subscribers)
                {{ trans('dashboard.subscribers.description') }}
                @else
                {{ trans('dashboard.subscribers.description_disabled') }}
                @endif
            </p>

            <div class="striped-list">
                @foreach($subscribers as $subscriber)
                <div class="row striped-list-item">
                    <div class="col-xs-3">
                        <p>{{ trans('dashboard.subscribers.subscriber', ['email' => $subscriber->email, 'date' => $subscriber->created_at]) }}</p>
                    </div>
                    <div class="col-xs-3">
                        @if(is_null($subscriber->getOriginal('verified_at')))
                        <b class="text-danger">{{ trans('dashboard.subscribers.not_verified') }}</b>
                        @else
                        <b class="text-success">{{ trans('dashboard.subscribers.verified') }}</b>
                        @endif
                    </div>
                    <div class="col-xs-3">
                        @if($subscriber->global)
                        <p>{{ trans('dashboard.subscribers.global') }}</p>
                        @elseif($subscriber->subscriptions->isNotEmpty())
                        {!! $subscriber->subscriptions->map(function ($subscription) {
                            return sprintf('<span class="label label-primary">%s</span>', $subscription->component->name);
                        })->implode(' ') !!}
                        @else
                        <p>{{ trans('dashboard.subscribers.no_subscriptions') }}</p>
                        @endif
                    </div>{{--
                    <div class="col-xs-2">
                        <p><input name="agree" type="checkbox" value="1"></p>
                    </div>--}}
                    <div class="col-xs-3 text-right">
                        <a href="{{ cachet_route('dashboard.subscribers.delete', [$subscriber->id], 'delete') }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
 
@if($current_user->isAdmin && $enable_subscribers)
<div class="content-wrapper header-fixed">
    <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.subscribers.sms') }}">
        {{ trans('dashboard.subscribers.sms.add.title') }}
    </a>
</div>
@endif
<div class="content-wrapper header-fixed">
    <p class="lead">
        @if($enable_subscribers)
        {{ trans('dashboard.subscribers.sms.description') }}
        @else
        {{ trans('dashboard.subscribers.description_disabled') }}
        @endif
    </p>
    <div class="striped-list">
        <div class="row striped-list-item">
            <div class="col-xs-3">
                <p>{{ trans('dashboard.subscribers.sms.email') }}</p>
            </div>
            <div class="col-xs-3">
                <p>{{ trans('dashboard.subscribers.sms.sms_number') }}</p>
            </div>
            <div class="col-xs-6">
                <p>{{ trans('dashboard.subscribers.sms.enabled') }}</p>
            </div>
        </div>
    @foreach($subscribers as $subscriber)
        @if($subscriber->sms_number)
        <div class="row striped-list-item">
            <div class="col-xs-3">
                <p>{{ $subscriber->email}}</p>
            </div>
            <div class="col-xs-3">
                <p>{{ $subscriber->sms_number }}</p>
            </div>
            <div class="col-xs-3">
            @if($subscriber->sms_notify)
            <p><i class="ion ion ion-checkmark"></i></p>
            @endif
            </div>
            <div class="col-xs-3 text-right">
                <a href="{{ cachet_route('dashboard.subscribers.delete_sms', [$subscriber->id], 'delete') }}" class="btn btn-danger" data-method='DELETE'>{{ trans('forms.delete') }}</a>
            </div>
        </div>
        @endif
    @endforeach
    </div>
</div>

@stop
