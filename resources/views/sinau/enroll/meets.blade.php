<x-gancang-pinter.admin>

    <x-slot name="sidebar">
        <x-gancang-pinter.course-sidebar :course="$course"></x-gancang-pinter.course-sidebar>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('enroll.show', [
                'enroll' => $course->id
            ]) }}">{{ $course->enroll->course->name }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('enroll.meet.show', [
                'enroll' => $course->id,
                'meet' => $meet->id
            ]) }}">{{ __('Pertemuan') }}</a>
        </li>
    </x-slot>

    <div class="card shadow rounded mb-4" style="border-radius: 1rem;" data-aos="flip-up">
        @if (Auth::user()->teacher)
            <div class="card-header d-flex justify-content-between">
                Tentang Pertemuan
                <div class="d-flex">
                    <a class="text-info mr-2" href="{{ route('enroll.meet.material.create', ['enroll' => $course->id, 'meet' => $meet->id]) }}">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a class="text-warning mr-2" href="{{ route('enroll.meet.edit', ['enroll' => $course->id, 'meet' => $meet->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('enroll.meet.destroy', ['enroll' => $course->id, 'meet' => $meet->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <a class="text-danger" href="{{ route('enroll.meet.destroy', ['enroll' => $course->id, 'meet' => $meet->id]) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                    </form>
                </div>
            </div>
            <div class="card-body">
                {{-- Date --}}
                <label class="font-weight-normal">Tanggal Pertemuan: </label>
                <h6>{{ $meet->date->translatedFormat('j F Y') }}</h6>

                {{-- Materi --}}
                <label class="font-weight-normal">Buka / Tutup Materi:</label>
                <h6>{{ $meet->opened_at || $meet->closed_at ?
                ($meet->opened_at ? 'Dibuka: '. $meet->opened_at->translatedFormat('j F Y H:i') : '').
                ($meet->closed_at ? ' Ditutup: '. $meet->closed_at->translatedFormat('j F Y H:i') : '')
                : 'Selalu dibuka'  }}</h6>

                {{-- Presensi --}}
                <a href="{{ route('teacherPresence', [
                    'enroll' => $course->id,
                    'meet' => $meet->id
                ]) }}" class="text-info">
                    <i class="fas fa-fingerprint"></i> Presensi
                </a>
                <h6>{{ $meet->presence_opened || $meet->presence_closed ?
                ($meet->presence_opened ? 'Dibuka: '. $meet->presence_opened : '').
                ($meet->presence_closed ? ' Ditutup: '. $meet->presence_closed : '')
                : 'Tidak melakukan presensi'  }}</h6>
            </div>

        @else
            <div x-data="{presence: false}" class="card-body">
                <p class="m-0">Tanggal: {{ $meet->date->translatedFormat('j F Y') }}</p>
                <span @click="presence = !presence" style="cursor: pointer;">
                    <i class="fas fa-fingerprint text-info"></i>
                    <span class="ml-2">Presensi</span>
                </span>

                @if ($form)
                    <form action="{{ route('enroll.meet.presence.store', [
                        'enroll' => $course->id,
                        'meet' => $meet->id
                    ]) }}" x-show="presence" method="post" class="mt-4">
                        @csrf
                        @foreach ($presensi as $key => $val)    
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="radio" class="custom-control-input" id="presensi{{ $key }}" name="presensi" value="{{ $val->id }}">
                            <label class="custom-control-label" for="presensi{{ $key }}">{{ $val->type }}</label>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-info">Simpan</button>
                        </div>
                    </form>
                @else
                    :<span class="ml-2">{{ $meet->presensi[0]->presence->type ?? 'Tanpa Keterangan' }}</span>
                @endif
            </div>
        @endif
    </div>

    
    <div x-data="{view:1}">
        <div class="d-flex justify-content-between">
            <h4 class="mb-0 text-info" data-aos="flip-up">{{ __('Pengumuman') }}</h4>
            @if (Auth::user()->teacher)
            <i @click="view = 2" x-show="view == 1" class="fas fa-edit text-info" style="cursor: pointer;"></i>
            <i @click="view = 1" x-show="view == 2" class="fas fa-times text-info" style="cursor: pointer;"></i>
            @endif
        </div>
        <div class="line mt-0 mb-4"></div>

        <article x-show="view == 1" data-aos="flip-down">{!! $course->announcement !!}</article>
        @if (Auth::user()->teacher)
            <form x-show="view == 2" action="{{ route('enroll.update', ['enroll' => $course->id]) }}" method="post" style="display: none;">
                @method('put')
                @csrf
                <textarea aria-label="Pengumuman" name="announcement" cols="30" rows="10">{!! $course->announcement !!}</textarea>

                <div class="d-flex mt-4">
                    <button type="submit" class="btn btn-info ml-auto">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>

            @push('js')
                <script>
                    $('textarea[name="announcement"]').summernote()
                </script>
            @endpush
        @endif
    </div>
    
    <div class="line my-4"></div>


</x-gancang-pinter.admin>