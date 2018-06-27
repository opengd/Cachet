<tr>
    <td class="header">
        <p style="text-align: center;">
        <img src="data:{{ $app_banner_type }};base64, {{ $app_banner }}" style="text-align: center; width=75px; height: 75px">
        </p>
        <a href="{{ $url }}">
            {{ $slot }}
        </a>
    </td>
</tr>
