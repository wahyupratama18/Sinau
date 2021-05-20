<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
            integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
            crossorigin="anonymous">
        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gancangpinter-app.css') }}">
        <title>Document</title>
    </head>
    <body>
        <nav id="navbar_top" class="navbar navbar-expand-lg fixed-top navbar-light">
            <a class="navbar-brand font-weight-bold" href="{{ route('landing') }}">Gancang Pinter</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse float-right" id="navbarNav">
                <div class="col-sm ml-4 p-2">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link font-weight-light" href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-light" href="{{ route('guru') }}">Guru</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            {{ $slot }}
        </main>
        
        <footer class="footer justify-content-center text-center mt-auto py-2">
            <div class="container">
                <p style="color: white; margin-top: 2vh;">
                    © 2021 Copyright Gancang Pinter
                </p>
            </div>
        </footer>
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>
</html>