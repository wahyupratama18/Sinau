<x-gancang-pinter.base css="gancangpinter-app.css">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    
    <div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header pb-2">
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('storage/logos/reel/144/white.png') }}" alt="" class="img-fluid" style="height: 50px;">
                </a>
            </div>

            <ul class="list-unstyled components">
                {{ $sidebar }}
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container-fluid d-flex justify-content-between">
                    <button
                        type="button"
                        id="sidebarCollapse"
                        class="btn btn-info rounded-circle">
                        <i class="fas fa-align-left"></i>
                    </button>

                    <div class="dropdown">
                        <span data-toggle="dropdown" style="cursor: pointer;">
                          {{ Auth::user()->name }}
                          <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width: 32px;" />
                        </span>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a>
                          <a class="dropdown-item" href="#">Link 2</a>
                          <a class="dropdown-item" href="#">Link 3</a>
                        </div>
                    </div>

                </div>
            </nav>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('landing') }}">{{ __('Beranda') }}</a>
                    </li>
                    {{ $breadcrumb ?? null }}
                </ol>
            </nav>

            {{ $slot }}

        </div>
    </div>

    
    @push('css')
        <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/solid.js" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/fontawesome.js" crossorigin="anonymous"></script>
        @laravelPWA
    @endpush
    
    @push('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({theme: "minimal"});
    
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    @endpush
</x-gancang-pinter.base>
