<div x-data="{}" wire:ignore x-init="() => {

    let choices = new Choices($refs.{{ $attributes['selectID'] }}, {
        itemSelectText: '',
        removeItemButton:true
    })
    choices.passedElement.element.addEventListener('change', e => {
        @this.set('{{ $attributes['wire:model'] }}', getSelectedValues($refs.{{ $attributes['selectID'] }}))
    }, false)
    items = {!! $attributes['selected'] ?? 'null' !!}

    if(Array.isArray(items)){
        items.forEach(s => {
            choices.setChoiceByValue((s).toString())
        })
    }
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
    <select id="{{ $attributes['selectID'] }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $attributes['selectID'] }}" multiple>
        {{ $options ?? '' }}
    </select>
</div>