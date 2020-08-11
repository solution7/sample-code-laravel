<!DOCTYPE html>
<html lang="{{SITE_LANG}}">
<head>
	<meta name="description" content="@yield('description')" />
	@if(env('production'))
		<meta name="robots" content="index, follow">
	@else
		<meta name="robots" content="noindex">
	@endif
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Language -->
	<meta name="app-lang" content="{{ SITE_LANG }}">

	@foreach ($languages as $language)
		<link name="{{$language->hrefLang}}-lang" rel="alternate" href="{{ str_replace(SITE_LANG, $language->lang, $requestURL) }}" hreflang="{{$defaultLang}}-{{ $language->hrefLang }}" />
	@endforeach

	<meta charset="UTF-8">

	  @if (CommonHelper::getHotJarID() != '' && env('APP_ENV') == 'production')
        <script>
    	    (function(h,o,t,j,a,r){
    	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    	        h._hjSettings={hjid:{!! "'"  . CommonHelper::getHotJarID() . "'"!!},hjsv:6};
    	        a=o.getElementsByTagName('head')[0];
    	        r=o.createElement('script');r.async=1;
    	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
    	        a.appendChild(r);
    	    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    	</script>
    @endif

		@if (CommonHelper::getGoogleTagManagerID() != '' && env('APP_ENV') !== 'production')
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(
			{'gtm.start': new Date().getTime(),event:'gtm.js'}
			);var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer', {!! "'"  . CommonHelper::getGoogleTagManagerID() . "'"!!});</script>
			<!-- End Google Tag Manager -->
    @endif

	<title>@yield('title'){{ ' - '. trans('common.Frilans_finans')}}  </title>
	<meta name="google-site-verification" content="k7obveuVipdI1dcNyJNAh6EOdKFrO9hq3HhCuGRUbG0" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="alternate" href="{{ $publicSiteUrl }}" hreflang="{{$segment1}}"/>
	<link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
	<!-- all:css -->
	<link rel="stylesheet" href="/assets/css/all.css" />

	<script>
		 WebFontConfig = {
				google: {
					families: ['Asap:400,700,400italic']
				}
		 };

		 (function(d) {
				var wf = d.createElement('script'), s = d.scripts[0];
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
				wf.async = true;
				s.parentNode.insertBefore(wf, s);
		 })(document);
	</script>
</head>

<body class="user-signed-out">
  <div id="app">
		@yield('content')
  </div>

	@php
		$appLangg = \App::getLocale();
	@endphp
	<script>
	    window.locale = "{{$appLangg}}";
			window.UrlLang = "{{URL_LANG}}";
			window.shortCode = "{{SITE_DOMAIN}}";
			window.systemCountryId = "{{SITE_COUNTRY}}";
	</script>
	<script rel="preconnect" src="{{ mix('assets/js/lang.js') }}" type="text/javascript"></script>
	<script rel="preconnect" src="{{ mix('assets/js/main.js') }}" type="text/javascript"></script>
	<script rel="preconnect" src="{{ mix('assets/js/app.js') }}" type="text/javascript"></script>
	<script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPtbrJC0eGXRV5Yg4zSiPwfUXopU2Tu64"></script>

 </body>
</html>
