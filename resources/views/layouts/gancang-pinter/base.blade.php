<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap">

        <link rel="stylesheet" href="{{ mix('css/pinterapp.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset("css/$css") }}">
        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @stack('css')
        @livewireStyles

        <script src="{{ mix('js/pinterapp.js') }}"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body>
        {{-- @guest --}}
        {{ $navbar }}
        {{-- @endguest --}}

        <main>
            {{ $slot }}
        </main>
        
        @guest
        <footer class="footer justify-content-center text-center mt-auto py-2">
            <div class="container">
                <p style="color: white; margin-top: 2vh;">
                    © 2021 Copyright Gancang Pinter
                </p>
            </div>
        </footer>
        @endguest

        @livewireScripts
        
        @stack('js')

        @if (session('message'))
        <script>
            window.addEventListener('alert', event => {
                
                data = {
                    message: "{{ session('message') }}",
                    position: 'topRight'
                }

                switch("{{ session('type') }}"){
                    case 'success':
                        iziToast.success(data)
                        break
                    case 'error':
                        iziToast.error(data)
                        break
                }


            })
        </script>
        @endif

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