@props([
    'name',
    'options',
    'title',
])

<div {{ $attributes }}>
    <fieldset>
        <legend class="text-lg font-bold">{{ $title }}</legend>
        @foreach($options as $label => $value)
            <div>
                <input type="checkbox"
                       name="{{ $name }}"
                       id="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"
                       value="{{ $value }}"
                />

                <label for="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"> {{ $label }}</label>
            </div>
        @endforeach
    </fieldset>

    <x-inputs.errors-field :name="$name"/>
</div>
