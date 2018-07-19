@component('mail::message')
<h2>{{ trans('notifications.incident.update.mail.title', ['name' => $name, 'new_status' => $new_status]) }}</h2>

<p>{{ $update->message }}</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

@if(Config::get('setting.mail-thanks-image-url')) 
<img class="line" alt="Linje" height="6" src="{{ Config::get('setting.mail-thanks-image-url') }}" width="125" />
@endif

@component('mail::thanks')
@endcomponent

@component('mail::ticket', ['ticket' => $update->incident->ticket, 'trans' => 'notifications.incident.new.mail.reference'])
@endcomponent

@include('notifications.partials.subscription')

@endcomponent