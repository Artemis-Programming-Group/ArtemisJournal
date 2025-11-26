<!DOCTYPE html>
<html class="dark" lang="{{ app()->getLocale() }}" dir="{{ array_search(app()->getLocale() , ['fa' , 'ar']) !== false ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">

    <link rel="manifest" href="{{ url('/manifest.webmanifest') }}">

    <link rel="apple-touch-icon" href="/icons/icon-192x192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <title>{{ $title ?? env('APP_NAME') }}</title>

    <link
        rel="alternate"
        type="application/rss+xml"
        title="Artemis Journal RSS"
        href="{{ route('feeds.main') }}" />


    {!! $meta ?? '<!-- page default meta -->' !!}


    <x-layouts.style>
        {!! $style ?? '<!-- page default style -->' !!}
    </x-layouts.style>




    @livewireStyles
    @vite(['resources/css/app.css' , 'resources/js/app.js'])
    @livewireScriptConfig
</head>

<body x-data="appInitializer" class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <x-layouts.header></x-layouts.header>

    <main>
        {{ $slot }}
    </main>

    <x-layouts.footer></x-layouts.footer>

    <x-layouts.script>
        {{ $script ?? '<!-- page default script -->' }}
    </x-layouts.script>
</body>

</html>
