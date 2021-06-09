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
            <h2 x-show="view == 2" class="cursor-pointer" wire:click="setID(null)" @click="view = 1"><i class="mdi mdi-chevron-left"></i> Kembali</h2>
        </div>
        <div class="p-4">
            <div x-show="view == 1">
                <x-tables>
                    <x-slot name="thead">
                        <tr>
                            <th class="border border-gray-600 p-2" style="width: 5%;">No</th>
                            <th class="border border-gray-600 p-2" style="width: 50%;">Nama</th>
                            <th class="border border-gray-600 p-2">Jenis Kelamin</th>
                            <th class="border border-gray-600 p-2">Kewenangan</th>
                            <th class="border border-gray-600 p-2">Opsi</th>        
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($teach as $key => $value)
                            <tr>
                                <td class="border border-gray-600 p-2">{{ 1 + $key }}</td>
                                <td class="border border-gray-600 p-2">{{ $value->user->name }}</td>
                                <td class="border border-gray-600 p-2">{{ $value->user->my_gender }}</td>
                                <td class="border border-gray-600 p-2">
                                    <ol class="list-disc ml-4">
                                        @foreach ($value->role as $tRole)
                                        <li>{{ $role[$tRole->role] }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td class="border border-gray-600 p-2">
                                    <x-jet-button
                                    wire:click="setID({{ $value->id }})"
                                    @click="view = 2"
                                    class="bg-yellow-500 hover:bg-yellow-600 mb-2">
                                        Edit Profil
                                    </x-jet-button>
                                    <x-jet-button wire:click="changePermission({{ $value->id }})" wire:loading.attr="disabled">
                                        Ubah Kewenangan
                                    </x-jet-button>
                                    @if ($value->user_id != Auth::id())    
                                    <x-jet-danger-button wire:click="destroy({{ $value->id }})">
                                        Hapus
                                    </x-jet-danger-button>
                                    @endif
            
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td class="p-2 text-center" colspan="100%">Data tidak tersedia</td>
                        </tr>
                        @endforelse
                    </x-slot>
                    <x-slot name="links">{{ $teach->links() }}</x-slot>
                </x-tables>
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
                        {{-- Alamat --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="address">{{ __('Alamat') }}</x-jet-label>
                            <textarea wire:model.defer="address" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <x-jet-input-error for="address" class="mt-2" />
                        </div>
                        {{-- Gender --}}
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="gender">{{ __('Jenis Kelamin') }}</x-jet-label>
                            <x-select.single wire:model="gender">
                                <x-slot name="options">
                                    <option placeholder>Pilih Jenis Kelamin</option>
                                    @foreach ($genders as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select.single>
                            <x-jet-input-error for="gender" class="mt-2" />
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

    {{-- Modal Here --}}
    <x-jet-dialog-modal wire:model="permission">
        <x-slot name="title">
            {{ __('Ubah Kewenangan') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Pilih kewenangan untuk pengguna.') }}

            <div class="mt-4">
                <x-select.multiple wire:model="access">
                    <x-slot name="options">
                        <option placeholder>Pilih hak akses</option>
                        @foreach ($role as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </x-slot>
                </x-select.multiple>

                <x-jet-input-error for="access" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('permission')" wire:loading.attr="disabled">
                {{ __('Batalkan') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updatePermission" wire:loading.attr="disabled">
                {{ __('Simpan') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</menu>
<x-asset-pusher :css="css('choices')" :js="js('choices')"/>