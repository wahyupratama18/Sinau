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
    </x-slot>

    <div class="card shadow rounded mb-4" style="border-radius: 1rem;" data-aos="flip-up">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $course->enroll->teacher->user->profile_photo_url }}" class="rounded-circle">
            <div class="ml-3">
                <h6>{{ __('Pengajar anda:') }}</h6>
                <span>{{ $course->enroll->teacher->user->name }}</span>
            </div>
        </div>
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