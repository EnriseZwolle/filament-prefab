@props([
    'name',
    'options',
    'title',
    'required' => false,
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}@if($required)*@endif</label>

    <select name="{{ $name }}"
            id="{{ $name }}"
            class="rounded-2xl w-full"
            @if($required) required @endif
    >
        <option value {{ old($name) == null ? "selected":"" }} id="{{ $name }}">{{ __('Select an option') }}</option>
        @foreach($options as $label => $value)
            <option value="{{ $value }}" {{ old($name) == $value ? "selected":"" }}>{{ $label }}</option>
        @endforeach
    </select>

    <x-inputs.errors-field :name="$name"/>
</div>
