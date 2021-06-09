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
                'meet' => $meet
            ]) }}">{{ __('Pertemuan') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('enroll.meet.material.create', [
                'enroll' => $course->id,
                'meet' => $meet
            ]) }}">{{ __('Materi') }}</a>
        </li>
    </x-slot>

    <form action="{{ route('enroll.meet.material.'.$route, $route == 'update' ? ['enroll' => $course->id, 'meet' => $meet, 'material' => null]
    : ['enroll' => $course->id, 'meet' => $meet]
    ) }}" method="post" enctype="multipart/form-data" class="dropzone">

        @if ($route == 'update')
            @method('put')
        @endif

        @csrf
        <div class="form-group">
            <label for="type">Tipe</label>
            <select name="type" id="type" class="form-control">
                @foreach ($material as $key => $val)
                    <option value="{{ $key }}" {{ $key == old('type') ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Judul</label>
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ?? null }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea aria-label="Description" name="description" cols="30" rows="10">{!! old('description') ?? null !!}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Unggah File</label>
            <input type="file" 
                class="filepond"
                name="filepond" 
                multiple 
                data-allow-reorder="true"
                data-max-file-size="3MB"
                data-max-files="3">
        </div>

        <div class="text-info">Opsional</div>
        <div class="form-group">
            <label for="opened_at">Materi Dibuka</label>
            <input id="opened_at" type="datetime-local" class="form-control" name="opened_at" value="{{ false ? $meet->opened_at->format('Y-m-d\TH:i') : old('opened_at') ?? null }}">
            @error('opened_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="closed_at">Materi Ditutup</label>
            <input id="closed_at" type="datetime-local" class="form-control" name="closed_at" value="{{ false ? $meet->closed_at->format('Y-m-d\TH:i') : old('closed_at') ?? null }}">
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

    @push('js')
        <script>
            $(document).ready(function() {
                $('textarea[name="description"]').summernote()
            })
        </script>
    @endpush

</x-gancang-pinter.admin>