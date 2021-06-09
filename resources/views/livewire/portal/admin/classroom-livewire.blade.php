<menu x-data="{view: 1}"
x-init="
@this.on('saved', () => { view = 1 })
@this.on('savedSiswa', () => view = 3)"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white flex">
            <div x-show="view == 1" class="w-full flex justify-between items-center">
                <h2>{{ __('Data Kelas') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2 || view == 3" class="cursor-pointer" wire:click="setID(null)" @click="view = 1"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
            <h2 x-show="view == 4" class="cursor-pointer" wire:click="setID(null)" @click="view = 3"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
            <div x-show="view == 3" class="ml-auto">
                <x-jet-button @click="view = 4">Tambah Peserta Didik</x-jet-button>
            </div>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 60%;">Nama Kelas</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($kelas as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->level.' '.$val->department->abbr.' '.$val->group }}</td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-button
                                    wire:click="setID({{ $val->id }})"
                                    @click="view = 3"
                                    class="bg-indigo-500 hover:bg-indigo-600 mb-2">
                                        Data Peserta Didik
                                    </x-jet-button>
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
                                <td class="p-2 text-center" colspan="3">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </x-slot>

                    <x-slot name="links">{{ $kelas->links() }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-10 gap-6">
                        {{-- Level --}}
                        <div class="col-span-3">
                            <x-jet-label for="level" value="{{ __('Tipe Kelas') }}" />

                            <x-select.single wire:model="level">
                                <x-slot name="options">
                                    <option placeholder>Pilih tipe kelas</option>
                                    @foreach ($types as $key)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>

                            <x-jet-input-error for="level" class="mt-2" />
                        </div>

                        {{-- Jurusan --}}
                        <div class="col-span-4">
                            <x-jet-label for="department" value="{{ __('Jurusan') }}" />

                            <x-select.single wire:model="department">
                                <x-slot name="options">
                                    <option placeholder>Pilih Jurusan</option>
                                    @foreach ($dept as $key)
                                        <option value="{{ $key->id }}">{{ "$key->long ($key->abbr)" }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>

                            <x-jet-input-error for="department" class="mt-2" />
                        </div>

                        {{-- Rombel --}}
                        <div class="col-span-3">
                            <x-jet-label for="group" value="{{ __('Rombel') }}" />
                            <x-jet-input id="group" type="number" class="mt-1 block w-full" wire:model.defer="group" />
                            <x-jet-input-error for="group" class="mt-2" />
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

                <x-select.single wire:model="yearSelection">
                    <x-slot name="options">
                        <option placeholder>Pilih tahun pelajaran</option>
                        @foreach ($years as $key)
                            <option value="{{ $key->id }}">{{ $key->start.'/'.$key->end }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>

                <form wire:submit.prevent="setWali" class="my-4 px-6 border border-gray-500 rounded-lg py-4">
                    <div class="mb-3">
                        <x-jet-label>Wali Kelas Saat Ini:</x-jet-label>
                        <x-jet-input type="text" class="mt-1 block w-full" wire:model="currentTeacher" readonly />
                    </div>
                    <x-jet-label for="teacher">Pilih Wali Kelas</x-jet-label>
                    <x-select.single wire:model="teacher">
                        <x-slot name="options">
                            <option placeholder>Pilih wali kelas</option>
                            @foreach ($teach as $key)
                                <option value="{{ $key->id }}">{{ $key->user->name }}</option>
                            @endforeach
                        </x-slot>
                    </x-select.single>
                    <div class="flex items-center justify-end px-4 py-3 text-right ">
                        <x-jet-button wire:loading.attr="disabled">
                            {{ __('Simpan') }}
                        </x-jet-button>
                    </div>
                </form>

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2">Nama Siswa</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($siswa as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->user->name }}</td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-danger-button wire:click="removeStudent({{ $val->classroom[0]->id }})">
                                        Hapus dari Kelas
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 text-center" colspan="3">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </x-slot>

                    <x-slot name="links">{{ $siswa ? $siswa->links() : null }}</x-slot>
                </x-tables>
            </div>

            <div x-show="view == 4">

                <form wire:submit.prevent="saveSiswa">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <x-jet-label for="students">Pilih Siswa</x-jet-label>
                            <x-select.multiple wire:model="students" :search="route('api.siswaByYear')">
                                <x-slot name="sParam">{ search: e.detail.value, year: @this.get('yearSelection') }</x-slot>
                            </x-select.multiple>
                            <x-jet-input-error for="students" class="mt-2" />
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