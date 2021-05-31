<x-gancang-pinter.admin>

    <x-slot name="sidebar">
        <x-gancangpinter.sidedrop href="course.enroll" :param="['enroll' => $course->id]" :title="$course->enroll->course->name"></x-gancangpinter.sidedrop>
        @if (Auth::user()->teacher)
            <hr class="m-0">
            <x-gancangpinter.sidedrop href="course.create" :param="['enroll' => $course->id]" title="Buat Pertemuan Baru"></x-gancangpinter.sidedrop>
            <hr class="m-0">
        @endif

        <li class="mt-2" style="padding-left: 10px; font-size: 10px;">Daftar Pertemuan:</li>
        @foreach ($course->meet as $key => $val)
            <x-gancangpinter.sidedrop href="course.meet.view" :param="['enroll' => $course->id, 'meet' => $val->id]" :title="'Pertemuan '.(1 + $key).' : '.$val->title"></x-gancangpinter.sidedrop>
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