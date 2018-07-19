@component('mail::message')
<h2>{{ trans('notifications.incident.update.mail.title', ['name' => $name, 'new_status' => $new_status]) }}</h2>

<p>{{ $update->message }}</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

@if(Config::get('setting.mail-thanks-image-url')) 
<img class="line" alt="Linje" height="6" src="{{ Config::get('setting.mail-thanks-image-url') }}" width="125" />
@endif

<p class="brg">Best regards,<br>
{{ Config::get('setting.app_name') }}</p>

@if($update->incident->ticket && $update->incident->ticket != "" && filter_var($update->incident->ticket, FILTER_VALIDATE_URL))
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => basename(parse_url($update->incident->ticket, PHP_URL_PATH))] ) }}</small>
@elseif($update->incident->ticket && $update->incident->ticket != "")
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => Str::words($update->incident->ticket)] ) }}</small>
@endif

@include('notifications.partials.subscription')

@endcomponent