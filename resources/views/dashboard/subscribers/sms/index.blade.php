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
                <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.sms.sms') }}
            </span>
            @if($currentUser->isAdmin && $enableSubscribers && $avaibleSubscribersCount > 0)
            <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.subscribers.sms.add') }}">
                {{ trans('dashboard.subscribers.sms.add.title') }}
            </a>
            @endif
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">
                    @if($enableSubscribers)
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
                            <a href="{{ cachet_route('dashboard.subscribers.edit', [$subscriber->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="{{ cachet_route('dashboard.subscribers.delete_sms', [$subscriber->id], 'delete') }}" class="btn btn-danger" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
