@extends('layout.dashboard')

@section('content')
<div class="content-panel">
    @includeWhen(isset($subMenu), 'dashboard.partials.sub-sidebar')
    <div class="content-wrapper">
        <div class="header sub-header">
            <div class="sidebar-toggler visible-xs">
                <i class="ion ion-navicon"></i>
            </div>
            <span class="uppercase">
                <i class="ion ion-ios-paper-outline"></i> {{ trans('dashboard.incidents.templates.update.title') }}
            </span>
            <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.templates.update.create') }}">
                {{ trans('dashboard.incidents.templates.update.add.title') }}
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="striped-list">
                    @forelse($incidentUpdateTemplates as $template)
                    <div class="row striped-list-item">
                        <div class="col-xs-6">
                            <strong>{{ $template->name }}</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ cachet_route('dashboard.templates.update.edit', [$template->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="{{ cachet_route('dashboard.templates.update.delete', [$template->id], 'delete') }}" class="btn btn-danger confirm-action" data-method='DELETE'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.incidents.templates.update.add.message') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@stop
