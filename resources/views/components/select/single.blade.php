<div x-data="{}" wire:ignore x-init="() => {

    let ch = new Choices($refs.{{ $id }}, {
        itemSelectText: '',
        removeItemButton:true
    }),
    selected = {!! $attributes['selected'] ?? 'null' !!}

    ch.passedElement.element.addEventListener('change', e => {
        @this.set('{{ $attributes['wire:model'] }}', e.detail.value)
    }, false)
    

    ch.setChoiceByValue(selected)
}">
    <!-- Be present above all else. - Naval Ravikant -->
    <select id="{{ $id }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $id }}">
        {{ $options ?? '' }}
    </select>
</div>