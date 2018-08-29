@if($daysToShow > 0 && $allIncidents)
@php
$total_ongoing_incidents = 0;
$total_past_incidents = 0;
$ongoing_incidents = array();
$past_incidents = array();
@endphp
@foreach($allIncidents as $date => $incidents)
@php
$ongoing_incidents[$date] = array();
$past_incidents[$date] = array();
foreach($incidents as $incident) {
    if($incident->status != 4) {
        array_push($ongoing_incidents[$date], $incident);
        $total_ongoing_incidents += 1;
    } else {
        $datediff = strtotime(date("Y-m-d")) - strtotime($date);
        $difference = floor($datediff/(60*60*24));
        if($difference==0) {
            array_push($past_incidents[$date], $incident);
            $total_past_incidents += 1;
        }
    }    
}
@endphp
@endforeach

@if($total_ongoing_incidents > 0)
<div class="section-timeline">
    <h1>{{ trans('cachet.incidents.ongoing') }}</h1>
    @foreach($ongoing_incidents as $date => $incidents)
        @if(count($incidents) > 0)
            @include('partials.incidents', [compact($date), compact($incidents)])
        @endif
    @endforeach 
</div>

<nav>
    <ul class="pager">
        @if($canPageBackward && true == false)
        <li class="previous">
            <a href="{{ cachet_route('status-page') }}?start_date={{ $previousDate }}" class="links">
                <span aria-hidden="true">&larr;</span> {{ trans('pagination.previous') }}
            </a>
        </li>
        @endif
        @if($canPageForward && true == false)
        <li class="next">
            <a href="{{ cachet_route('status-page') }}?start_date={{ $nextDate }}" class="links">
                {{ trans('pagination.next') }} <span aria-hidden="true">&rarr;</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
@endif
@if($total_past_incidents > 0)
<div class="section-timeline">
<h1>{{ trans('cachet.incidents.past') }}</h1>
    @foreach($past_incidents as $date => $incidents)
    @php
    $datediff = strtotime(date("Y-m-d")) - strtotime($date);
    $difference = floor($datediff/(60*60*24));
    @endphp
    @if($difference==0 && count($incidents) > 0)
    @include('partials.incidents', [compact($date), compact($incidents)])
    @endif
    @endforeach
</div>

<nav>
    <ul class="pager">
        @if($canPageBackward && true == false)
        <li class="previous">
            <a href="{{ cachet_route('status-page') }}?start_date={{ $previousDate }}" class="links">
                <span aria-hidden="true">&larr;</span> {{ trans('pagination.previous') }}
            </a>
        </li>
        @endif
        @if($canPageForward && true == false)
        <li class="next">
            <a href="{{ cachet_route('status-page') }}?start_date={{ $nextDate }}" class="links">
                {{ trans('pagination.next') }} <span aria-hidden="true">&rarr;</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
@endif
@endif
