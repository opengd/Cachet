@component('mail::message')
# {{ trans('notifications.incident.update.mail.title', ['name' => $name, 'new_status' => $new_status]) }}

{{ $update->message }}

@if($update->incident->ticket && $update->incident->ticket != "" && filter_var($update->incident->ticket, FILTER_VALIDATE_URL))
{{ basename(parse_url($update->incident->ticket, PHP_URL_PATH)) }}
@elseif($update->incident->ticket && $update->incident->ticket != "")
{{ Str::words($update->incident->ticket)}}
@endif

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

Thanks,<br>
{{ Config::get('setting.app_name') }}

@include('notifications.partials.subscription')

@endcomponent
