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
            <a href="{{ route('enroll.meet.create', [
                'enroll' => $course->id
            ]) }}">{{ __('Pertemuan') }}</a>
        </li>
    </x-slot>

    <form action="{{ route('enroll.meet.'.$route, $route == 'update' ? ['enroll' => $course->id, 'meet' => $meet->id]
    : ['enroll' => $course->id]
    ) }}" method="post">

        @if ($route == 'update')
            @method('put')
        @endif

        @csrf
        <div class="form-group">
            <label for="title">Judul Pertemuan</label>
            <input id="title" type="text" class="form-control" name="title" value="{{ $meet->title ?? old('title') ?? null }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="date">Tanggal Pertemuan</label>
            <input id="date" type="date" class="form-control" name="date" value="{{ isset($meet) ? $meet->date->toDateString() : old('date') ?? null }}">
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        {{-- Opsional --}}
        <div class="text-info">Opsional</div>
        <div class="form-group">
            <label for="presence_opened">Presensi Dibuka</label>
            <input id="presence_opened" type="time" class="form-control" name="presence_opened" value="{{ isset($meet) ? date('H:i', strtotime($meet->presence_opened)) : old('presence_opened') ?? null }}">
            @error('presence_opened')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="presence_closed">Presensi Ditutup</label>
            <input id="presence_closed" type="time" class="form-control" name="presence_closed" value="{{ isset($meet) ? date('H:i', strtotime($meet->presence_closed)) : old('presence_closed') ?? null }}">
            @error('presence_closed')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        

        <div class="form-group">
            <label for="opened_at">Materi Dibuka</label>
            <input id="opened_at" type="datetime-local" class="form-control" name="opened_at" value="{{ isset($meet) ? $meet->opened_at->format('Y-m-d\TH:i') : old('opened_at') ?? null }}">
            @error('opened_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="closed_at">Materi Ditutup</label>
            <input id="closed_at" type="datetime-local" class="form-control" name="closed_at"  value="{{ isset($meet) ? $meet->closed_at->format('Y-m-d\TH:i') : old('closed_at') ?? null }}">
            @error('closed_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submission --}}
        <div class="d-flex mt-4">
            <button type="submit" class="btn btn-info ml-auto">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
    
    <div class="line my-4"></div>


</x-gancang-pinter.admin>