<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.8.55/css/materialdesignicons.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @stack('css')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        @stack('js')
    </head>
    <body x-data="{ open: false }"
    class="font-sans antialiased"
    :class="{'overflow-hidden': open}">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <main class="mt-16">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        {{-- @stack('js') --}}
        <script>
            window.addEventListener('alert', event => {
                
                data = {
                    title: event.detail.title ?? '',
                    message: event.detail.message,
                    position: 'topRight'
                }

                switch(event.detail.type){
                    case 'success':
                        iziToast.success(data)
                        break
                    case 'error':
                        iziToast.error(data)
                        break
                }


            })
        </script>
    </body>
</html>
