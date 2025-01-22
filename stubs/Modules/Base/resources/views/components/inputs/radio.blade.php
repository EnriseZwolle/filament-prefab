@props([
    'name',
    'options',
    'title',
    'errors',
    'required' => false
])

<div {{ $attributes }}>
    <fieldset>
        <legend class="text-lg font-bold">{{ $title }}@if($required)*@endif</legend>
        @foreach($options as $label => $value)
            <div>
                <input type="radio"
                       name="{{ $name }}"
                       id="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"
                       value="{{ $value }}"
                       @if($required) required @endif
                />

                <label for="{{ ($loop->index == 0 ? $name : $name . '-' . $value) }}"> {{ $label }}</label>
            </div>
        @endforeach
    </fieldset>

    <x-inputs.errors-field :errors="$errors" :name="$name"/>
</div>
