@component('mail::message')
# {{ $greeting }}

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

{{ $content }}

Thanks,<br>
{{ Config::get('setting.app_name') }}

@endcomponent
