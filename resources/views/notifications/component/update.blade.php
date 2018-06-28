@component('mail::message')
# {{ $greeting }}

{{ $content }}

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

Thanks,<br>
{{ Config::get('setting.app_name') }}

@include('notifications.partials.subscription')

@endcomponent
