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
            'meet' => $meet
        ]) }}">{{ __('Pertemuan') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('teacherPresence', [
            'enroll' => $course->id,
            'meet' => $meet
        ]) }}">{{ __('Data Presensi') }}</a>
    </li>
</x-slot>

<div class="table-responsive">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th class="text-center" colspan="{{ $presensi->count() }}">Presensi</th>
            </tr>
            <tr>
                @foreach ($presensi as $key)
                    <th>{{ $key->type }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($student as $key => $val)
                <tr>
                    <td>{{ 1 + $key }}</td>
                    <td>{{ $val->user->name }}</td>
                    @foreach ($presensi as $p => $present)
                        <td>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="presensi{{ $key.$p }}" wire:click="setPresent({{ $present->id }}, {{ $val->id }})" name="presensi" value="{{ $val->id }}" {{ $val->presensi->isNotEmpty() && $val->presensi[0]->presence_id == $present->id ? 'checked' : '' }}>
                                <label class="custom-control-label" for="presensi{{ $key.$p }}"></label>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
