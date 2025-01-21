@props([
    'name',
    'title',
    'required' => false,
    'errors'
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}@if($required)*@endif</label>

    <textarea
        class="rounded-2xl w-full"
        name="{{ $name }}"
        id="{{ $name }}"
        @if($required) required @endif
    ></textarea>

    <x-inputs.errors-field :errors="$errors" :name="$name"/>
</div>
