<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white">
            <div x-show="view == 1" class="flex justify-between items-center">
                <h2>{{ __('Data Tahun Pelajaran') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view != 1" class="cursor-pointer" wire:click="setID(null)" @click="view = 1"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 75%;">Tahun Pelajaran</th>
                            <th class="border border-gray-600 p-2">Opsi</th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($tahun as $key => $val)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $val->start.'/'.$val->end }}</td>
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
                                <td class="p-2 text-center" colspan="3">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </x-slot>

                    <x-slot name="links">{{ $tahun->links() }}</x-slot>
                </x-tables>

            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-7 gap-6">
                        {{-- Start --}}
                        <div class="col-span-3">
                            <x-jet-label for="start" value="{{ __('Tahun Awal') }}" />
                            <x-jet-input id="start" type="number" class="mt-1 block w-full" wire:model.defer="start" min="2000" />
                            <x-jet-input-error for="start" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-center text-lg">/</div>
                        {{-- End --}}
                        <div class="col-span-3">
                            <x-jet-label for="end" value="{{ __('Tahun Akhir') }}" />
                            <x-jet-input id="end" type="number" class="mt-1 block w-full" wire:model.defer="end" min="2000" />
                            <x-jet-input-error for="end" class="mt-2" />
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