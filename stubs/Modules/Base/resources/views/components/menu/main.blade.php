@props([
    'textColor' => null,
])

@if($menuItems->count())
<ul {{ $attributes->merge(['class' => 'list-none']) }}>
    @foreach($menuItems as $menuItem)
        @if($menuItem->children->count())
            <li class="relative border-b border-slate-200 lg:border-none">
                <span class="js-toggle-submenu flex lg:inline-flex items-center py-2 px-4 cursor-pointer underline underline-offset-4 decoration-2 decoration-transparent hover:decoration-current transition duration-150 ease-in-out {{ $textColor }}"
                      tabindex="0"
                      aria-expanded="false"
                      role="button">
                    {{ $menuItem->title }}
                    <x-svg class="svg-icon relative inline-flex self-center h-5 w-5 ml-2"
                           src="assets/svg/chevron-down.svg"/>
                </span>

                <x-menu.submenu :parent="$menuItem"
                                :items="$menuItem->children"
                                text-color="text-primary"
                                class="js-submenu relative flex-col gap-1.5 pl-4 mb-2 lg:gap-3 lg:absolute lg:min-w-full lg:right-0 lg:bottom-0 lg:transform lg:translate-y-full lg:bg-white lg:rounded lg:shadow-md lg:p-4 lg:mb-0"/>
            </li>
        @else
            <li class="relative border-b border-slate-200 lg:border-none">
                <a class="flex lg:inline-flex py-2 px-4 underline underline-offset-4 decoration-2 decoration-transparent transition duration-150 ease-in-out {{ $textColor }} @if($menuItem->getUrl() === url()->current()) font-bold @else hover:decoration-current @endif"
                   href="{{ $menuItem->getUrl() }}"
                   @if($menuItem->getUrl() === url()->current()) aria-current="page" @endif
                   @if(is_external_url($menuItem->getUrl())) target="_blank" rel="noopener" @endif
                >
                    {{ $menuItem->title }}

                    @if(is_external_url($menuItem->getUrl()))
                        <x-svg
                            class="svg-icon relative inline-flex self-center h-6 w-6 ml-2"
                            src="assets/svg/external-link.svg"
                        />
                    @endif
                </a>
            </li>
        @endif
    @endforeach
</ul>
@endif
