@props([
    'name',
    'options',
    'title',
    'errors',
    'required' => false
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}@if($required)*@endif</label>

    <fieldset>
        @foreach($options as $label => $value)
            <legend class="inline-block">
                <input type="radio"
                       name="{{ $name }}"
                       id="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"
                       value="{{ $value }}"
                       @if($required) required @endif
                />

                <label for="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"> {{ $label }}</label>
            </legend>
        @endforeach
    </fieldset>

    <x-inputs.errors-field :errors="$errors" :name="$name"/>
</div>
