<menu x-data="{view: 1}"
x-init="@this.on('saved', () => { view = 1 })"
class="py-12 mx-auto px-6">
    {{-- Stop trying to control. --}}
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-3 bg-gray-600 rounded-t-lg text-white">
            <div x-show="view == 1" class="flex justify-between items-center">
                <h2>{{ __('Data Guru') }}</h2>
                <x-jet-button @click="view = 2">Tambah Data</x-jet-button>
            </div>
            <h2 x-show="view == 2" class="cursor-pointer" @click="view = 1">< Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">
                <div class="flex justify-between my-3">
                    <!-- pagination -->
                    <div>
                        <label for="">Pilih</label>
                        <select wire:model="paginate">
                            @for($i=5; $i <= 25; $i+=5)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        data
                    </div>
                    <!-- search -->
                    <div>
                        Cari
                        <input type="text" wire:model="search" class="shadow appearance-none border rounded w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
        
                <table class="table-auto w-full border-collapse border border-gray-600">
                    <thead class="bg-gray-400">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 75%;">Nama</th>
                            <th class="border border-gray-600 p-2">Opsi</th>        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teach as $key => $value)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $value->user->name }}</td>
                                <td class="border border-gray-600 p-2">
                                    <button
                                    wire:click="form({{ $value->id }})"
                                    class="focus:outline-none my-1 text-white text-sm py-2 px-5 rounded-full bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">
                                        Edit
                                    </button>
                                    <button
                                    wire:click="destroy({{ $value->id }})"
                                    class="focus:outline-none my-1 text-white text-sm py-2 px-5 rounded-full bg-red-500 hover:bg-red-600 hover:shadow-lg">
                                        Hapus
                                    </button>
            
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-2">
                    {{-- {{ $teach->links() }} --}}
                </div>
            </div>

            <div x-show="view == 2">
                <form wire:submit.prevent="save">
                    <div class="px-4 py-5 sm:p-6 grid grid-cols-6 gap-6">
                        {{-- Nama --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="name" value="{{ __('Nama') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        {{-- NIP --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="nip" value="{{ __('NIP') }}" />
                            <x-jet-input id="nip" type="text" class="mt-1 block w-full" wire:model.defer="nip" />
                            <x-jet-input-error for="nip" class="mt-2" />
                        </div>
                        {{-- Email --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>
                        {{-- POB --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="tempatLahir" value="{{ __('Tempat Lahir') }}" />
                            <x-jet-input id="tempatLahir" type="text" class="mt-1 block w-full" wire:model.defer="tempatLahir" />
                            <x-jet-input-error for="tempatLahir" class="mt-2" />
                        </div>
                        {{-- DOB --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="tanggalLahir" value="{{ __('Tanggal Lahir') }}" />
                            <x-jet-input id="tanggalLahir" type="date" class="mt-1 block w-full" wire:model.defer="tanggalLahir" max="{{ now()->subYears(10)->toDateString() }}" />
                            <x-jet-input-error for="tanggalLahir" class="mt-2" />
                        </div>
                        {{-- Phone --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="phone_number" value="{{ __('Nomor Telepon') }}" />
                            <x-jet-input id="phone_number" type="number" class="mt-1 block w-full" wire:model.defer="phone_number" />
                            <x-jet-input-error for="phone_number" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <x-jet-label for="address">{{ __('Alamat') }}</x-jet-label>
                            <textarea wire:model.defer="address" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <x-jet-input-error for="address" class="mt-2" />
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