<x-gancang-pinter.admin>

    <x-slot name="sidebar">
        <li style="padding: 10px;">{{ $course->enroll->course->name }}</li>
        @foreach ([] as $key)
            <x-gancangpinter.sidedrop href="bySemester" :param="['semester' => $key->id]" :title="$key->year->start.'/'.$key->year->end.' '.ucfirst($key->remarks)"></x-gancangpinter.sidedrop>
        @endforeach
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('course.enroll', [
                'enroll' => $course->id
            ]) }}">{{ $course->enroll->course->name }}</a>
        </li>
    </x-slot>

    <div class="card shadow rounded mb-4" style="border-radius: 1rem;">
        <div class="card-body d-flex align-items-center">
            <img src="{{ $course->enroll->teacher->user->profile_photo_url }}" class="rounded-circle">
            <div class="ml-3">
                <h6>{{ __('Pengajar anda:') }}</h6>
                <span>{{ $course->enroll->teacher->user->name }}</span>
            </div>
        </div>
    </div>

    <h4 class="mb-0">{{ __('Pengumuman') }}</h4>
    <div class="line mt-0 mb-4"></div>

    {{ $course->announcement }}
    
    <div class="line my-4"></div>

</x-gancang-pinter.admin>