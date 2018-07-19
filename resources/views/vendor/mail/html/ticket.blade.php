@if($ticket && $ticket  != "" && filter_var($ticket, FILTER_VALIDATE_URL))
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => basename(parse_url($ticket, PHP_URL_PATH))] ) }}</small>
@elseif($ticket && $ticket != "")
<small>{{ trans('notifications.incident.new.mail.reference', ['reference' => Str::words($ticket)] ) }}</small>
@endif