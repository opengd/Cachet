<p class="brg">Best regards,<br>
@if(Config::get('setting.mail-thanks-from'))
{{ Config::get('setting.mail-thanks-from') }}
@else
{{ Config::get('setting.app_name') }}
@endif
</p>