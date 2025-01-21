@props([
    'name',
    'errors'
])

@if($errors->has($name))
    @foreach($errors->get($name) as $error)
        <div class="text-red-500 text-sm">
            {{ $error }}
        </div>
    @endforeach
@endif
