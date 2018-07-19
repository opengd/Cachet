@component('mail::message')
<h2>{{ trans('notifications.incident.new.mail.greeting', ['app_name' => Config::get('setting.app_name')]) }}</h2>

<p>{{ $incident->message }}</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

@if(Config::get('setting.mail-thanks-image-url')) 
<img class="line" alt="Linje" height="6" src="{{ Config::get('setting.mail-thanks-image-url') }}" width="125" />
@endif

@component('mail::thanks')
@endcomponent

@component('mail::ticket', ['ticket' => $incident->ticket, 'trans' => 'notifications.incident.new.mail.reference'])
@endcomponent

@include('notifications.partials.subscription')

@endcomponent
