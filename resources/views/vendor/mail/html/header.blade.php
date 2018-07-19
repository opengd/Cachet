<!--
<tr>
    <td class="header">
        <p><img src="data:{{ $appBannerType }};base64, {{ $appBanner }}"></p>
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    </td>
</tr>
-->
<center>
    @if(Config::get('setting.mail-header-image-url'))
    <a href="{{ $url }}">
        <img alt="logo" height="75" src="{{ Config::get('setting.mail-header-image-url') }}"/>
    </a>
    @elseif($appBanner)
    <a href="{{ $url }}">
        <img alt="logo" height="75" src="data:{{ $appBannerType }};base64, {{ $appBanner }}">
    </a>
    @endif
</center>