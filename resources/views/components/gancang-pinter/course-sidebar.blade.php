<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
<x-gancangpinter.sidedrop href="enroll.show" :param="['enroll' => $course->id]" :title="$course->enroll->course->name"></x-gancangpinter.sidedrop>
@if (Auth::user()->teacher)
    <hr class="m-0">
    <x-gancangpinter.sidedrop href="enroll.meet.create" :param="['enroll' => $course->id]" title="Buat Pertemuan Baru"></x-gancangpinter.sidedrop>
    <hr class="m-0">
@endif

<li class="mt-2" style="padding-left: 10px; font-size: 10px;">Daftar Pertemuan:</li>
@foreach ($course->meet as $key => $val)
    <x-gancangpinter.sidedrop href="enroll.meet.show" :param="['enroll' => $course->id, 'meet' => $val->id]" :title="'Pertemuan '.(1 + $key).' : '.$val->title"></x-gancangpinter.sidedrop>
@endforeach