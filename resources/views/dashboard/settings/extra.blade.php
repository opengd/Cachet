@extends('layout.dashboard')

@section('content')
<div class="content-panel">
    @includeWhen(isset($subMenu), 'dashboard.partials.sub-sidebar')
    <div class="content-wrapper">
        <div class="header sub-header" id="application-setup">
            <span class="uppercase">
                {{ trans('dashboard.settings.extra.extra') }}
            </span>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form id="settings-form" name="SettingsForm" class="form-vertical" role="form" action="{{ cachet_route('dashboard.settings', [], 'post') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('partials.errors')
                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('forms.settings.extra.banner-image') }}</label>
                                    <input type="text" class="form-control" name="banner-image-url" value="{{ Config::get('setting.banner-image-url') }}" placeholder="{{ trans('forms.settings.extra.banner-image') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('forms.settings.extra.mail-header-image') }}</label>
                                    <input type="text" class="form-control" name="mail-header-image-url" value="{{ Config::get('setting.mail-header-image-url') }}" placeholder="{{ trans('forms.settings.extra.mail-header-image') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('forms.settings.extra.mail-thanks-image') }}</label>
                                    <input type="text" class="form-control" name="mail-thanks-image-url" value="{{ Config::get('setting.mail-thanks-image-url') }}" placeholder="{{ trans('forms.settings.extra.mail-thanks-image') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('forms.settings.extra.mail-thanks-from') }}</label>
                                    <input type="text" class="form-control" name="mail-thanks-from" value="{{ Config::get('setting.mail-thanks-from') }}" placeholder="{{ trans('forms.settings.extra.mail-thanks-from') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('forms.settings.extra.sms-test-message') }}</label>
                                    <input type="text" class="form-control" name="sms-test-message" value="{{ Config::get('setting.sms-test-message') }}" placeholder="{{ trans('notifications.subscriber.sms.test.content') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="0" name="use-status-labels">
                                        <input type="checkbox" value="1" name="use-status-labels" {{ Config::get('setting.use-status-labels') ? 'checked' : null }}>
                                        {{ trans('forms.settings.extra.use-status-labels') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@stop