<div>
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

    <table class="table-auto w-full border-collapse border border-green-600">
        <thead class="bg-gradient-to-r from-green-400 to-blue-500 text-white">
            <tr>
                <th class="border border-green-600 p-2" style="width: 5%;">No</th>
                <th class="border border-green-600 p-2" style="width: 75%;">Nama</th>
                <th class="border border-green-600 p-2">Opsi</th>        
            </tr>
        </thead>
        <tbody>
            @foreach($peserta as $key => $value)
            <tr>
                <td class="border border-green-600 p-2">{{ 1 + $key }}</td>
                <td class="border border-green-600 p-2">{{ $value->name }}</td>
                <td class="border border-green-600 p-2">
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

                    @if($active != $value->id)
                    <button
                    wire:click="tampil({{ $value->id }})"
                    class="focus:outline-none my-1 text-white text-sm py-2 px-5 rounded-full bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                        Nyatakan Tampil
                    </button>
                    @else
                    <button
                    wire:click="finished()"
                    class="focus:outline-none my-1 text-white text-sm py-2 px-5 rounded-full bg-purple-500 hover:bg-purple-600 hover:shadow-lg">
                        Selesai Tampil
                    </button>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-2">
        {{ $peserta->links() }}
    </div>
</div>
