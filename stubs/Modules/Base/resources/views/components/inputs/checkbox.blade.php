@props([
    'name',
    'options',
    'title',
    'errors'
])

<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-lg font-bold">{{ $title }}</label>

    <fieldset>
        @foreach($options as $label => $value)
            <legend class="inline-block">
                <input type="checkbox"
                       name="{{ $name }}"
                       id="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"
                       value="{{ $value }}"/>

                <label for="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"> {{ $label }}</label>
            </legend>
        @endforeach
    </fieldset>

    <x-inputs.errors-field :errors="$errors" :name="$name"/>
</div>
