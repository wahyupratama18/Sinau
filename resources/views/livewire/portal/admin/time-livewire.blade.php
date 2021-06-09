<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white">
            <div x-show="view == 1" class="flex justify-between items-center">
                <h2>{{ __('Jam Pembelajaran') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2" class="cursor-pointer" wire:click="setID(null)" @click="view = 1"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">

                {{-- Day --}}
                <x-select.single wire:model="tDay">
                    <x-slot name="options">
                        <option placeholder>Pilih Hari</option>
                        @foreach ($days as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-slot>
                </x-select.single>

                <x-tables :search="false">
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2">Jam Ke</th>
                            <th class="border border-gray-600 p-2">Waktu</th>
                            <th class="border border-gray-600 p-2 w-2/6">Opsi</th>        
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($times as $key => $value)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $value->ordered }}</td>
                                <td class="border border-gray-600 p-2">{{ $value->time_start.' - '.$value->time_end }}</td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-button
                                    wire:click="setID({{ $value->id }})"
                                    @click="view = 2"
                                    class="bg-yellow-500 hover:bg-yellow-600 mb-2">
                                        Edit
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="destroy({{ $value->id }})">
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
                    <x-slot name="links">{{ $times->links() }}</x-slot>
                </x-tables>
            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">
                        {{-- Day --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="day">{{ __('Hari') }}</x-jet-label>
                            <x-select.single wire:model="day">
                                <x-slot name="options">
                                    <option placeholder>Pilih Hari</option>
                                    @foreach ($days as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>
                            <x-jet-input-error for="day" class="mt-2" />
                        </div>
                        {{-- Jam --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="ordered" value="{{ __('Jam Ke') }}" />
                            <x-jet-input id="ordered" type="number" class="mt-1 block w-full" wire:model.defer="ordered" min="1" max="20" />
                            <x-jet-input-error for="ordered" class="mt-2" />
                        </div>
                        {{-- Start --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="time_start" value="{{ __('Waktu Dimulai') }}" />
                            <x-jet-input id="time_start" type="time" class="mt-1 block w-full" wire:model.defer="time_start" />
                            <x-jet-input-error for="time_start" class="mt-2" />
                        </div>
                        {{-- End --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="time_end" value="{{ __('Waktu Diakhiri') }}" />
                            <x-jet-input id="time_end" type="time" class="mt-1 block w-full" wire:model.defer="time_end" />
                            <x-jet-input-error for="time_end" class="mt-2" />
                        </div>
                    </div>

                    {{-- Submission --}}
                    <div class="flex items-center justify-end px-4 py-3 text-right ">
                        <x-jet-button wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                    {{-- End Submission --}}
                </form>
            </div>
        </div>
    </div>

</menu>
<x-asset-pusher :css="css('choices')" :js="js('choices')"/>