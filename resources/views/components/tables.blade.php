<div class="flex justify-between my-3">
    @if ($paginate !== false)    
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
    @endif

    @if ($search !== false)    
    <!-- search -->
    <div>
        Cari
        <input type="text" wire:model="search" class="shadow appearance-none border rounded w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @endif
</div>

<table class="table-auto w-full border-collapse border border-gray-600">
    <thead class="bg-gray-400">
        {{ $thead }}
    </thead>
    <tbody>
        {{ $tbody }}
    </tbody>
</table>

<div class="mt-2">
    {{ $links }}
</div>