<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white">
            <div x-show="view == 1" class="flex justify-between items-center">
                <h2>{{ __('Data Semester') }}</h2>
                <x-jet-button wire:click="setID(null)" @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view != 1" class="cursor-pointer" wire:click="setID(null)" @click="view = 1">< Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 35%;">Tahun Pelajaran</th>
                            <th class="border border-gray-600 p-2" style="width: 35%;">Semester</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($semester as $key => $val)
                            <tr @if ($val->active)
                                class="bg-blue-400 text-white"
                            @endif>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->year->start.'/'.$val->year->end }}</td>
                                <td class="border border-gray-600 p-2">{{ ucfirst($val->remarks) }}</td>
                                <td class="border border-gray-600 p-2">
                                    @if (!$val->active)    
                                    <x-jet-button
                                    wire:click="setActive({{ $val->id }})"
                                    class="bg-green-500 hover:bg-green-600 mb-2">
                                        Nyatakan Semester Aktif
                                    </x-jet-button>
                                    @endif
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
                                <td class="p-2 text-center" colspan="4">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </x-slot>

                    <x-slot name="links">{{ $semester->links() }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">
                        <div class="col-span-3">
                            <x-jet-label for="year" value="{{ __('Tahun Pelajaran') }}" />

                            <x-select.single wire:model="year">
                                <x-slot name="options">
                                    <option placeholder>Pilih tahun pelajaran</option>
                                    @foreach ($tahun as $key)
                                        <option value="{{ $key->id }}">{{ $key->start.'/'.$key->end }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>

                            <x-jet-input-error for="year" class="mt-2" />
                        </div>

                        <div class="col-span-3">
                            <x-jet-label for="remarks" value="{{ __('Semester') }}" />

                            <x-select.single wire:model="remarks">
                                <x-slot name="options">
                                    <option placeholder>Pilih semester</option>
                                    @foreach ($mark as $key)
                                        <option value="{{ $key }}">{{ ucfirst($key) }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>

                            <x-jet-input-error for="remarks" class="mt-2" />
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
                3
            </div>
        </div>
    </div>

</menu>
<x-asset-pusher :css="css('choices')" :js="js('choices')"/>