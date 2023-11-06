<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    darkMode: $persist(false),
    monochromeMode: $persist(false),
    dir: @js(current_lang('dir') ?: 'ltr'),
    lang: @js(str_replace('_', '-', app()->getLocale()))
 }" :class="darkMode ? 'dark' : ''" dir="{{ current_lang('dir') ?: 'ltr' }}">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} @isset($title)
            | {{ $title }}
        @endisset
    </title>

    <!-- CSS & JS Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>

    @isset($head)
        {{ $head }}
    @endisset

    @livewireStyles
</head>
<body x-data x-bind="$store.global.documentBody" :class="monochromeMode ? 'is-monochrome' : ''"
      class="@isset($isSidebarOpen) {{ $isSidebarOpen ? 'is-sidebar-open' : '' }} @endisset @isset($isHeaderBlur) {{ $isHeaderBlur ? 'is-header-blur' : '' }} @endisset @isset($hasMinSidebar) {{
      $hasMinSidebar ? 'has-min-sidebar' : '' }} @endisset  @isset($headerSticky) {{ $headerSticky ? 'is-header-not-sticky' : '' }} @endisset">

<!-- App preloader-->
<x-layouts.preloader></x-layouts.preloader>

<!-- Page Wrapper -->
<div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>

    @unless(auth()->guest())
        <!-- Sidebar -->
        <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            <x-layouts.main-sidebar></x-layouts.main-sidebar>

            <!-- Sidebar Panel -->
            @if($hasSidePanel)
                <x-layouts.sidebar-panel></x-layouts.sidebar-panel>
            @endif
        </div>

        <!-- App Header -->
        <x-layouts.header></x-layouts.header>

        <!-- Mobile Searchbar -->
        <x-layouts.mobile-searchbar></x-layouts.mobile-searchbar>

        <!-- Right Sidebar -->
        <x-layouts.right-sidebar></x-layouts.right-sidebar>

        <main class="main-content w-full px-[var(--margin-x)] pb-8">
            {{ $slot }}
        </main>
    @else
        {{ $slot }}
    @endunless
</div>

<x-modals.modal-delete></x-modals.modal-delete>

<!--
This is a place for Alpine.js Teleport feature
@see https://alpinejs.dev/directives/teleport
-->
<div id="x-teleport-target"></div>

@isset($scripts)
    {{ $scripts }}
@endisset

<div id="x-teleport-scripts"></div>

@livewireScripts

<script type="text/javascript">
    @if(session()->has('toast'))
    window.addEventListener('DOMContentLoaded', function () {
        Toast.fire({
            icon: "{{ session('toast')['icon'] }}",
            title: "{{ session('toast')['message'] }}"
        })
    })
    @endif
    window.addEventListener('toast', function (evt) {
        Toast.fire(evt.detail)
    })
    window.addEventListener('swal', function (evt) {
        Swal.fire(evt.detail)
    })
</script>

</body>

</html>
