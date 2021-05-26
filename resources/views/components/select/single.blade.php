<div x-data="{}" wire:ignore x-init="() => {

    let {{ $id }} = new Choices($refs.{{ $id }}, {
        itemSelectText: '',
        removeItemButton:true
    }),
    selected = {!! $attributes['selected'] ?? 'null' !!}

    {{ $id }}.passedElement.element.addEventListener('change', e => {
        @this.set('{{ $attributes['wire:model'] }}', e.detail.value)
    }, false)

    @if ($search)
        let search = null
        {{ $id }}.passedElement.element.addEventListener('search', e => {
            if (e.detail.value.length > 0 && search !== e.detail.value){
                axios.get('{{ $search }}', {
                    params: @if ($sParam) {{ $sParam }} @else { search: e.detail.value } @endif
                }).then(result => {
                    {{ $id }}.setChoices(result.data,'id','text', true)._handleSearch(e.detail.value)
                })
                search = e.detail.value
            }
        })
    @endif
    

    {{ $id }}.setChoiceByValue(selected)
}">
    <!-- Be present above all else. - Naval Ravikant -->
    <select id="{{ $id }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $id }}">
        {{ $options ?? '' }}
    </select>
</div>