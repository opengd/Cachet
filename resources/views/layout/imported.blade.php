<template id="t">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="env" content="{{ app('env') }}">
<meta name="token" content="{{ csrf_token() }}">
<!-- Mobile friendliness -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="description" content="@yield('description', trans('cachet.meta.description.overview', ['app' => $appName]))">

<meta http-equiv="cleartype" content="on">
@if($enableExternalDependencies)
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset={{ $fontSubset }}" rel="stylesheet" type="text/css">
@endif
<link rel="stylesheet" href="{{ mix('/dist/css/app.css') }}">

@include('partials.stylesheet')

@include('partials.crowdin')

@if($appStylesheet)
<style type="text/css">
{!! $appStylesheet !!}
</style>
@endif

<script type="text/javascript">
    var Global = {};
    var refreshRate = parseInt("{{ $appRefreshRate }}");

    function refresh() {
        window.location.reload(true);
    }

    if (refreshRate > 0) {
        setTimeout(refresh, refreshRate * 1000);
    }

    Global.locale = '{{ $appLocale }}';
</script>
<script src="{{ mix('dist/js/manifest.js') }}"></script>
<script src="{{ mix('dist/js/vendor.js') }}"></script>

<div class="status-page @yield('bodyClass')">
    @yield('outer-content')

    <script>
        // Remove Banner Image if page is inside of iframe.
        if ( top !== self ) {
            var appBanners = document.getElementsByClassName("app-banner");
            
            for(i = 0; i < appBanners.length; i++) {
                appBanners[i].outerHTML = "";
            }
        }
    </script>

    <div class="container" id="app">
        @yield('content')
    </div>

    @yield('bottom-content')
</div>
<script src="{{ mix('dist/js/all.js') }}"></script>
</template>
<script>
  (function() {
    var importDoc = document.currentScript.ownerDocument; // importee

    // Define and register <shadow-element>
    // that uses Shadow DOM and a template.
    var proto2 = Object.create(HTMLElement.prototype);

    proto2.createdCallback = function() {
      // get template in import
      var template = importDoc.querySelector('#t');

      // import template into
      var clone = document.importNode(template.content, true);

      var root = this.createShadowRoot();
      root.appendChild(clone);
    };

    document.registerElement('shadow-element', {prototype: proto2});
  })();
</script>