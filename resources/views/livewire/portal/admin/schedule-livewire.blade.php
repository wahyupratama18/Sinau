<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Because she competes with no one, no one can compete with her. --}}
    
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white flex">
            <div x-show="view == 1" class="w-full flex justify-between items-center">
                <h2>{{ __('Jadwal Pelajaran') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2 || view == 3" class="cursor-pointer" wire:click="setID(null)" @click="view = 1">< Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                <x-jet-label for="class_id">Pilih Kelas</x-jet-label>
                <x-select.single wire:model="class_id">
                    <x-slot name="options">
                        <option placeholder>Pilih kelas</option>
                        @foreach ($kelas as $key)
                            <option value="{{ $key->id }}">{{ $key->level.' '.$key->department->abbr.' '.$key->group }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>
                
                <x-jet-label for="semester" class="mt-3">Pilih Semester</x-jet-label>
                <x-select.single wire:model="semester_id">
                    <x-slot name="options">
                        <option placeholder>Pilih semester</option>
                        @foreach ($semester as $key)
                            <option value="{{ $key->id }}">{{ $key->year->start.'/'.$key->year->end.' '.$key->remarks }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2">Mata Pelajaran</th>
                            <th class="border border-gray-600 p-2">Pengajar</th>
                            <th class="border border-gray-600 p-2">Jadwal</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($enrolls as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->enroll->course->name }}</td>
                                <td class="border border-gray-600 p-2">{{ '('.$val->enroll->course->abbr.$val->enroll->course_increment.') '.$val->enroll->teacher->user->name }}</td>
                                <td class="border border-gray-600 p-2">
                                    <ol>
                                        @foreach ($val->schedule as $sch)
                                            <li>
                                                <span>
                                                    {{ $sch->time->day_name.' '.$sch->time->ordered.' ('.$sch->time->time_start.' - '.$sch->time->time_end.')' }}
                                                    <i class="mdi mdi-trash-can-outline text-red-500 cursor-pointer" wire:click="removeSchedule({{ $sch->id }})"></i>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-button
                                    wire:click="setID({{ $val->id }})"
                                    @click="view = 3"
                                    class="bg-green-500 hover:bg-green-600 mb-2">
                                        Tambah Jadwal
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="destroy({{ $val->id }})">
                                        Hapus
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 text-center" colspan="100%">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </x-slot>

                    <x-slot name="links">{{ $enrolls ? $enrolls->links() : null }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-3 gap-6">

                        {{-- Mapel Baru --}}
                        <div class="col-span-3">
                            <x-jet-label for="enroll_id" value="{{ __('Mata Pelajaran') }}" />

                            <x-select.multiple wire:model="enroll_id" :search="route('api.enrollBySemester')">
                                <x-slot name="sParam">{ search: e.detail.value, semester: @this.get('semester_id') }</x-slot>
                            </x-select.multiple>

                            <x-jet-input-error for="enroll_id" class="mt-2" />
                        </div>

                    </div>

                    {{-- Submission --}}
                    <div class="flex items-center justify-end px-4 py-3 text-right ">
                        <x-jet-button wire:loading.attr="disabled">
                            {{ __('Simpan') }}
                        </x-jet-button>
                    </div>
                    {{-- End Submission --}}
                </form>
            </div>

            <div x-show="view == 3">

                <form wire:submit.prevent="newTime">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-3 gap-6">

                        {{-- Jam Baru --}}
                        <div class="col-span-3">
                            <x-jet-label for="time_id" value="{{ __('Pilih Jam') }}" />
                            
                            <x-select.multiple wire:model="time_id">
                                <x-slot name="options">
                                    <option placeholder>Pilih tahun pelajaran</option>
                                    @foreach ($time as $key)
                                        <option value="{{ $key->id }}">{{ "$key->day_name $key->ordered ($key->time_start - $key->time_end)" }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.multiple>

                            <x-jet-input-error for="time_id" class="mt-2" />
                        </div>

                    </div>

                    {{-- Submission --}}
                    <div class="flex items-center justify-end px-4 py-3 text-right ">
                        <x-jet-button wire:loading.attr="disabled">
                            {{ __('Simpan') }}
                        </x-jet-button>
                    </div>
                    {{-- End Submission --}}
                </form>

            </div>
        </div>
    </div>

</menu>
<x-asset-pusher :css="css('choices')" :js="js('choices')"/>