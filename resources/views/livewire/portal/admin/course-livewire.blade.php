<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white flex">
            <div x-show="view == 1" class="w-full flex justify-between items-center">
                <h2>{{ __('Data Pelajaran') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2" class="cursor-pointer" wire:click="setID(null)" @click="view = 1">< Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 20%;">Nama Mata Pelajaran</th>
                            <th class="border border-gray-600 p-2" style="width: 40%;">Deskripsi Pelajaran</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($course as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ "($val->abbr) $val->name" }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->description }}</td>
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

                    <x-slot name="links">{{ $course->links() }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">

                        {{-- Nama --}}
                        <div class="col-span-6 md:col-span-3">
                            <x-jet-label for="name" value="{{ __('Nama Mata Pelajaran') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>

                        {{-- Singkatan --}}
                        <div class="col-span-6 md:col-span-3">
                            <x-jet-label for="abbr" value="{{ __('Singkatan') }}" />
                            <x-jet-input id="abbr" type="text" class="mt-1 block w-full" wire:model.defer="abbr" />
                            <x-jet-input-error for="abbr" class="mt-2" />
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-span-6">
                            <x-jet-label for="description" value="{{ __('Deskripsi') }}" />
                            <textarea wire:model.defer="description" id="description" rows="3" class="mit-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <x-jet-input-error for="description" class="mt-2" />
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