<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="bg-white shadow-md rounded-lg">

        <div class="p-3 bg-gray-600 rounded-t-lg text-white flex">
            <div x-show="view == 1" class="w-full flex justify-between items-center">
                <h2>{{ __('Data Pengajar - Mapel') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2" class="cursor-pointer" wire:click="setID(null)" @click="view = 1"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
        </div>

        <div class="p-4">
            <div x-show="view == 1">

                <x-jet-label for="semester">Pilih Semester</x-jet-label>
                <x-select.single wire:model="semesterID">
                    <x-slot name="options">
                        <option placeholder>Pilih semester</option>
                        @foreach ($semester as $key)
                            <option value="{{ $key->id }}">{{ $key->year->start.'/'.$key->year->end.' '.ucfirst($key->remarks) }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>

                <x-jet-label for="teacher" class="mt-3">Pilih Pengajar</x-jet-label>
                <x-select.single wire:model="teacherID">
                    <x-slot name="options">
                        <option placeholder>Pilih pengajar</option>
                        @foreach ($teacher as $key)
                            <option value="{{ $key->id }}">{{ $key->user->name }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 15%;">Kode Pelajaran</th>
                            <th class="border border-gray-600 p-2" style="width: 50%;">Mata Pelajaran</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($enroll as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->course->abbr.$val->course_increment }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->course->name }}</td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-button
                                    wire:click="setID({{ $val->id }})"
                                    @click="view = 2"
                                    class="bg-yellow-500 hover:bg-yellow-600 mb-2">
                                        Edit
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

                    <x-slot name="links">{{ $enroll->links() }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">

                        {{-- Mapel --}}
                        <div class="col-span-6 md:col-span-3">
                            <x-jet-label for="courseID" value="{{ __('Mata Pelajaran') }}" />

                            <x-select.single wire:model="courseID">
                                <x-slot name="options">
                                    <option placeholder>Pilih mapel</option>
                                    @foreach ($course as $key)
                                        <option value="{{ $key->id }}">{{ "($key->abbr) $key->name" }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>

                            <x-jet-input-error for="courseID" class="mt-2" />
                        </div>

                        {{-- Increment --}}
                        <div class="col-span-6 md:col-span-3">
                            <x-jet-label for="course_inc" value="{{ __('Urutan') }}" />
                            <x-jet-input id="course_inc" type="number" class="mt-1 block w-full" wire:model.defer="course_inc" />
                            <x-jet-input-error for="course_inc" class="mt-2" />
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
<x-asset-pusher :css="css('choices')" :js="js('choices')"></x-asset-pusher>