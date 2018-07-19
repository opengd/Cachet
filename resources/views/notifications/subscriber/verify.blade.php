@component('mail::message')
<h2>{{ $greeting }}</h2>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

<p>{{ $content }}</p>

@if(Config::get('setting.mail-thanks-image-url')) 
<img class="line" alt="Linje" height="6" src="{{ Config::get('setting.mail-thanks-image-url') }}" width="125" />
@endif

<p class="brg">Best regards,<br>
{{ Config::get('setting.app_name') }}</p>

@endcomponent
