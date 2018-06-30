@extends('layout.dashboard')

@section('content')
<div class="header">
    <div class="sidebar-toggler visible-xs">
        <i class="ion ion-navicon"></i>
    </div>
    <span class="uppercase">
        <i class="ion ion-ios-email-outline"></i> {{ trans('dashboard.subscribers.subscribers') }}
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
                <label for="email">{{ trans('forms.user.email') }}</label>
                <input type="text" class="form-control" name="email" id="email" required value="{{$subscriber->email}}" placeholder="{{ trans('forms.user.email') }}">
            </div>

            <input type="hidden" name="verified" value="0">
            <div class="form-group">
                <label for="verified">{{ trans('dashboard.subscribers.verified') }}</label>
                <p><input name="verified" type="checkbox" value="1" {{ $subscriber->getIsVerifiedAttribute() ? "checked" : "" }}></p>
            </div>

            @if($componentGroups->isNotEmpty() || $ungroupedComponents->isNotEmpty())
            @foreach($componentGroups as $componentGroup)
            <div class="list-group components">
                @if($componentGroup->enabled_components->count() > 0)
                <div class="list-group-item group-name">
                    <strong>{{ $componentGroup->name }}</strong>
                </div>
                @foreach($componentGroup->enabled_components()->orderBy('order')->get() as $component)
                @include('partials.component_input', compact($component))
                @endforeach
                @endif
            </div>
            @endforeach

            @if($ungroupedComponents->isNotEmpty())
            <ul class="list-group components">
                <div class="list-group-item group-name">
                    <strong>{{ trans('cachet.components.group.other') }}</strong>
                </div>
                @foreach($ungroupedComponents as $component)
                @include('partials.component_input', compact($component))
                @endforeach
            </ul>
            @endif
            @else
            <p>{{ trans('cachet.subscriber.manage.no_subscriptions') }}</p>
            @endif

            <input type="hidden" name="email-notify" value="0">
            <div class="form-group">
                <label for="email-notify">{{ trans('dashboard.subscribers.email_enabled') }}</label>
                <p><input name="email-notify" type="checkbox" value="1" {{ $subscriber->email_notify ? Binput::old('email_notify', 'checked') : "" }}></p>
            </div>

            </fieldset>

            <div class="form-group">
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    <a class="btn btn-default" href="{{ cachet_route('dashboard.subscribers') }}">{{ trans('forms.cancel') }}</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@stop