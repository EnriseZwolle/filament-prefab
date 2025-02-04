@props([
    'parent' => null,
    'items' => null,
    'textColor' => null,
])

<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @if($parent)
        <li>
            <a href="{{ $parent->url }}"
               class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($parent->url === url()->current()) font-bold @else hover:decoration-current @endif"
               @if($parent->getUrl() === url()->current()) aria-current="page" @endif>
                {{ $parent->title }}
            </a>
        </li>
    @endif

    @forelse ($items as $item)
        <li>
            <a href="{{ $item->getUrl() }}"
               class="flex py-1.5 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($item->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
               @if($item->getUrl() === url()->current()) aria-current="page" @endif
               @if(is_external_url($item->getUrl())) target="_blank" rel="noopener" @endif
            >
                {{ $item->title }}

                @if(is_external_url($item->getUrl()))
                    <x-svg
                        class="svg-icon relative inline-flex self-center h-6 w-6 ml-2"
                        src="assets/svg/external-link.svg"
                    />
                @endif
            </a>
        </li>
    @empty
    @endforelse
</ul>
