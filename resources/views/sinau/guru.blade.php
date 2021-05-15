<x-gancang-pinter>
    <!--Content-->
    <div class="justify-content-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 10vh;">
            <div class="container">
                <h1 class="display-4">Yuk, kenali proses pembelajaran disini</h1>
                <p class="lead">Halaman ini akan memberikan kamu gambaran tentang bagaimana proses pembelajaran akan berlangsung</p>
            </div>
        </div>
        <div class="container p-4">
            <div class="row">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Modul</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Tugas</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Ujian</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Hasil Akhir</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="row">
                                        <div class="col-sm-4">
                                                Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros
                                        </div>
                                        <div class="col sm-8" style="max-height: 10%;">
                                                <div class="card" style="width: 18rem;">
                                                    <img class="card-img-top" src="{{ asset('images/icons/banner.png') }}" alt="Card image cap">
                                                    <div class="card-body">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">this is second</div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">this is third</div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">this is fourth</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-gancang-pinter>