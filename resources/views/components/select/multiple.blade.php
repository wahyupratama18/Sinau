<div x-data="{}" wire:ignore x-init="() => {

    let {{ $id }} = new Choices($refs.{{ $id }}, {
        itemSelectText: '',
        removeItemButton:true
    })
    {{ $id }}.passedElement.element.addEventListener('change', e => {
        @this.set('{{ $attributes['wire:model'] }}', getSelectedValues($refs.{{ $id }}))
    }, false)
    items = {!! $attributes['selected'] ?? 'null' !!}

    if(Array.isArray(items)){
        items.forEach(s => {
            {{ $id }}.setChoiceByValue((s).toString())
        })
    }

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
}
getSelectedValues = select => {
    let result = [],
        options = select && select.options,
        opt
    
    for(let i = 0; i < options.length; i++){
        opt = options[i]
        if(opt.selected) result.push(opt.value || opt.text)
    }
    return result
}
">
    <!-- Be present above all else. - Naval Ravikant -->
    <select id="{{ $id }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $id }}" multiple>
        {{ $options ?? '' }}
    </select>
</div>