@if($appFooter)
{!! $appFooter !!}
@else
<footer class="footer" style="height: 135px">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="list-inline" style="text-align: center;">
                    @if($showSupport)
                    <p>
                        {!! trans('cachet.powered_by') !!}
                        @if($showTimezone)
                        {{ trans('cachet.timezone', ['timezone' => $timezone]) }}
                        @endif
                    </p>
                    @endif
                    @if($currentUser || $dashboardLink)
                    <li>
                        <a class="btn btn-link" href="{{ cachet_route('dashboard') }}">{{ trans('dashboard.dashboard') }}</a>
                    </li>
                    @endif
                    @if($currentUser)
                    <li>
                        <a class="btn btn-link" href="{{ cachet_route('auth.logout') }}">{{ trans('dashboard.logout') }}</a>
                    </li>
                    @endif
                    @if($enableSubscribers)
                    <li>
                        <a class="btn btn-success btn-outline" href="{{ cachet_route('subscribe') }}">{{ trans('cachet.subscriber.button') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="text-align: center;">
                <h4>{{ trans('cachet.get_subscribe') }}</h4>
            </div>
        </div>
    </div>
</footer>
@endif

@include("partials.analytics")
