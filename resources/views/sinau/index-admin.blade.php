<x-gancang-pinter.admin>
    <x-slot name="sidebar">
        <li style="padding: 10px;">Pilih Semester</li>
        @foreach ($semester as $key)
            <x-gancangpinter.sidedrop href="bySemester" :param="['semester' => $key->id]" :title="$key->year->start.'/'.$key->year->end.' '.ucfirst($key->remarks)"></x-gancangpinter.sidedrop>
        @endforeach
        {{-- <x-gancangpinter.sidedrop title="Testing" :sub="[
            (object) ['href' => route('landing'), 'title' => 'Name']
        ]">
        </x-gancangpinter.sidedrop> --}}
    </x-slot>

    <div class="row mt-3"> 
        @foreach ($lesson as $key)
            <a href="{{ route('course.enroll', ['enroll' => $key->id]) }}" class="col-md-4 my-2" data-aos="flip-down" data-aos-easing="linear" data-aos-duration="500">
                <div class="bg-info w-full p-3 rounded shadow text-white d-flex align-items-center" style="min-height: 10rem;">
                    <div>
                        <h6>{{ '('.$key->enroll->course->abbr.$key->enroll->course_increment.') '.$key->enroll->course->name }}</h6>
                        <span class="leading-tight">{{ $key->enroll->teacher->user->name }}</span><br>
                        <span style="opacity: 75%;">{{ $key->history->classroom->level.' '.$key->history->classroom->department->abbr.' '.$key->history->classroom->group }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{-- <h2>Yuk, Selesaikan Pelajaran Kamu!</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <div class="line"></div> --}}
</x-gancang-pinter.admin>