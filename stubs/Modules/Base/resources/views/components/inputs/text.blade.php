@props([
    'name',
    'title',
    'required' => false,
    'type' => 'text'
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}@if($required)*@endif</label>

    <input type="{{ $type }}"
           class="rounded-2xl w-full"
           name="{{ $name }}"
           id="{{ $name }}"
           @if($required) required @endif
           value="{{ old($name) }}"
    >

    <x-inputs.errors-field :name="$name"/>
</div>
