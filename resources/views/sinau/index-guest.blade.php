<x-gancang-pinter.guest>
    <div class="jumbotron">
        <div class="col" style="margin-top: 10vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="d-flex flex-column">
                            <h1 class="display-4">
                                <div class="font-weight-bold p-2">
                                    Halo, Selamat Datang!
                                </div>
                            </h1>
                            <p class="lead p-2" style="max-width: 75vh;">Aplikasi web pembelajaran Ini
                                dirancang Untuk memudahkan kamu semua dalam proses pembelajaran. Selamat Belajar
                                Ya !</p>
                        </div>
                    </div>
                    <div class="col-m-7">
                        <div class="float-xl-right">
                            <img src="{{ asset('images/icons/banner.png') }}" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="card-solid gradient-custom text-center justify-content-center"
        style="margin-top: -5vh;">
        <div class="card-body">
            <h4 class="font-weight-bold" style="margin-top: 1.5vh;color: white;">Yuk, Mulai Belajar!</h4>
            <button type="button" class="btn btn-outline-light">
                <a class="btn" href="{{ route('login') }}" style="color: black;" role="button">
                    Login Disini
                </a>
            </button>
        </div>
    </div>
    <div class="container p-4" style="margin-top: 4vh;">
        <div class="float-center">
            <h4 class="text-center text-lowercase font-weight-bold" style="color: #487eb0">
                Kelebihan Fitur yang Kami Miliki
            </h4>
            <div class="container p-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">
                                    is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                    been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a
                                    type specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-4 justify-content-center text-center">
        <div class="card">
            <div class="card-header" style="background-color: transparent;">
                Quote
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0 font-weight-light">
                    <p>Education is the passport to the future, for tomorrow belongs to those who
                        prepare for it today.</p>
                    <footer class="blockquote-footer">El-Hajj Malik El-Shabazz</footer>
                </blockquote>
            </div>
        </div>
    </div>
</x-gancang-pinter.guest>