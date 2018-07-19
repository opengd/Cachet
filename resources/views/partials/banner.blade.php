@if($appHeader)
{!! $appHeader !!}
@else
@if($appBanner || Config::get('setting.banner-image-url'))
<div @if($appBannerStyleFullWidth)class="app-banner"@endif>
    <div class="container">
        <div class="row app-banner-padding  @if(!$appBannerStyleFullWidth) app-banner @endif">
            <div class="col-md-12 text-center">
                @if($appDomain)
                    @if(Config::get('setting.banner-image-url'))
                    <a href="{{ $appDomain }}" class="links"><img src="{{ Config::get('setting.banner-image-url') }}" class="banner-image img-responsive"></a>
                    @else
                    <a href="{{ $appDomain }}" class="links"><img src="data:{{ $appBannerType }};base64, {{ $appBanner }}" class="banner-image img-responsive"></a>
                    @endif
                @else
                    @if(Config::get('setting.banner-image-url'))
                    <img src="{{ Config::get('setting.banner-image-url') }}" class="banner-image img-responsive">
                    @else
                    <img src="data:{{ $appBannerType }};base64, {{ $appBanner }}" class="banner-image img-responsive">
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endif
