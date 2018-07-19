@component('mail::message')
<h2>{{ trans('notifications.incident.new.mail.greeting', ['app_name' => Config::get('setting.app_name')]) }}</h2>

<p>{{ $incident->message }}</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

@if(Config::get('setting.mail-thanks-image-url')) 
<img class="line" alt="Linje" height="6" src="{{ Config::get('setting.mail-thanks-image-url') }}" width="125" />
@endif

<p class="brg">Best regards,<br>
{{ Config::get('setting.app_name') }}</p>

@if($incident->ticket && $incident->ticket != "" && filter_var($incident->ticket, FILTER_VALIDATE_URL))
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => basename(parse_url($incident->ticket, PHP_URL_PATH))] ) }}</small>
@elseif($incident->ticket && $incident->ticket != "")
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => Str::words($incident->ticket)] ) }}</small>
@endif

@include('notifications.partials.subscription')

@endcomponent
