<x-gancang-pinter.base css="gancangpinter-guest.css">
    <x-slot name="navbar">
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
    </x-slot>

    <!-- Be present above all else. - Naval Ravikant -->
    {{ $slot }}
</x-gancang-pinter.base>