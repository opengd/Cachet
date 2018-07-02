@extends('layout.dashboard')

@section('content')
<div class="content-panel">
    @includeWhen(isset($subMenu), 'dashboard.partials.sub-sidebar')
    <div class="content-wrapper">
        <div class="header sub-header">
            <div class="sidebar-toggler visible-xs">
                <i class="ion ion-navicon"></i>
            </div>
            <span class="uppercase">
                <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.subscribers') }}
            </span>
            @if($currentUser->isAdmin && $enableSubscribers)
            <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.subscribers.create') }}">
                {{ trans('dashboard.subscribers.add.title') }}
            </a>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">
                    @if($enableSubscribers)
                    {{ trans('dashboard.subscribers.description') }}
                    @else
                    {{ trans('dashboard.subscribers.description_disabled') }}
                    @endif
                </p>

                <div class="striped-list">
                    <div class="row striped-list-item">
                            <div class="col-xs-3">
                                <p>{{ trans('dashboard.subscribers.sms.subscriber') }}</p>
                            </div>
                            <div class="col-xs-2">
                                <p>{{ trans('dashboard.subscribers.verified') }}</p>
                            </div>
                            <div class="col-xs-2">
                                <p>{{ trans('dashboard.subscribers.notify') }}</p>
                            </div>
                            <div class="col-xs-2">
                                <p>{{ trans('dashboard.subscribers.components') }}</p>
                            </div>
                            <div class="col-xs-3">
                            </div>
                        </div>
                    @foreach($subscribers as $subscriber)
                    <div class="row striped-list-item">
                        <div class="col-xs-3">
                            <p style="word-break: break-all;">
                                <a href="mailto:{{ $subscriber->email }}">{{ $subscriber->email }}</a>
                                <p><small>{{ trans('dashboard.subscribers.subscribed', ['date' => $subscriber->created_at]) }}</small></p>
                            </p>
                        </div>
                        <div class="col-xs-2">
                            @if(is_null($subscriber->getOriginal('verified_at')))
                            <b class="text-danger">{{ trans('dashboard.subscribers.not_verified') }}</b>
                            @else
                            <b class="text-success">{{ trans('dashboard.subscribers.verified') }}</b>
                            @endif
                        </div>
                        <div class="col-xs-2">
                            @if($subscriber->email_notify)
                            <p><i class="ion ion ion-checkmark"></i></p>
                            @endif
                        </div>
                        <div class="col-xs-2">
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
                            <a href="{{ cachet_route('dashboard.subscribers.edit', [$subscriber->id]) }}" class="btn btn-info">{{ trans('forms.manage') }}</a>
                            <a href="{{ cachet_route('dashboard.subscribers.delete', [$subscriber->id], 'delete') }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
