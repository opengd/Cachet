@component('mail::message')
# {{ trans('notifications.incident.new.mail.greeting', ['app_name' => Config::get('setting.app_name')]) }}

{{ $incident->message }}

@if($incident->ticket && $incident->ticket != "" && filter_var($incident->ticket, FILTER_VALIDATE_URL))
{{ basename(parse_url($incident->ticket, PHP_URL_PATH)) }}
@elseif($incident->ticket && $incident->ticket != "")
{{ Str::words($incident->ticket)}}
@endif

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

Thanks,<br>
{{ Config::get('setting.app_name') }}

@include('notifications.partials.subscription')

@endcomponent
