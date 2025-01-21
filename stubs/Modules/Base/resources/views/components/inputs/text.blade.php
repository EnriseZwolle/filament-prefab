@props([
    'name',
    'title',
    'required' => false,
    'errors',
    'type' => 'text'
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}@if($required)*@endif</label>

    <input type="{{ $type }}"
           class="rounded-2xl w-full"
           name="{{ $name }}"
           id="{{ $name }}"
           @if($required) required @endif
    >

    <x-inputs.errors-field :errors="$errors" :name="$name"/>
</div>
