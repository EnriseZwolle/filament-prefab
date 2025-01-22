@props([
    'name'
])

@error($name)
    <div class="text-sm text-red-500">{{ $message }}</div>
@enderror
