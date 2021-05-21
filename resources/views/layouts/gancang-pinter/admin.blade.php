<x-gancang-pinter.base css="gancangpinter-app.css">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>
                    <a href="{{ route('landing') }}">Gancang Pinter</a>
                </h3>
            </div>

            <ul class="list-unstyled components">
                {{ $sidebar }}
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container-fluid">
                    <button
                        type="button"
                        id="sidebarCollapse"
                        class="btn btn-info"
                        style="border-radius: 100%;">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button
                        class="btn btn-dark d-inline-block d-lg-none ml-auto"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('landing') }}">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                        </ul>
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
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    
        <script
        defer="defer"
        src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
        <script
        defer="defer"
        src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>
    @endpush
    
    @push('js')
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
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
