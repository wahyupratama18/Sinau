<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
            
        <link rel="stylesheet" href="{{ mix('css/pinterapp.css') }}">    
        <link rel="stylesheet" type="text/css" href="{{ asset("css/$css") }}">
        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @stack('css')

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
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
            <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
        @stack('js')
    </body>
</html>