@php
    $pages = \App\Models\Page::all();
    $categories = \App\Models\PageCategory::has('pages')->get();
    $menuItems = \App\Models\MenuItem::orderBy('order')->get();
@endphp
<header>
    <nav class="navbar bg-primary text-primary-content">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    @foreach ($pages as $page)
                        @if ($page->page_category_id == null)
                            <li><a href="/{{ $page->buildSlug() }}"
                                    class="@if (request()->is($page)) text-accent @endif">{{ str()->headline($page->name) }}</a>
                            </li>
                        @endif
                    @endforeach
                    @foreach ($categories as $category)
                        <li>
                            <a>{{ $category->name }}</a>
                            <ul class="p-2">
                                @foreach ($category->pages as $page)
                                    <li><a href="/{{ $page->buildSlug() }}"
                                            class="@if (request()->is($page)) text-accent @endif">{{ str()->headline($page->name) }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                    @auth
                        <li><a href="{{ url('/admin') }}">
                                Admin
                            </a></li>
                    @else
                        <li><a href="{{ route('login') }}">
                                Log in
                            </a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">
                                    Register
                                </a></li>
                        @endif
                    @endauth
                </ul>
            </div>
            <a class="text-xl hover:font-bold flex flex-row gap-4" href="/"><x-application-mark
                    class="h-16"></x-application-mark>
                {{ config('app.name') }}</a>
        </div>
        <div class="navbar-center hidden md:flex">
            <ul class="menu menu-horizontal px-1">
                @foreach ($menuItems as $item)
                    @if ($item->pages->count() > 1)
                        <li>
                            <details>
                                <summary class="hover:font-bold ">{{ $item->name }}</summary>
                                <ul class="p-2 z-40 w-48 bg-primary text-primary-content">
                                    @foreach ($item->pages as $page)
                                        <li><a href="/{{ $page->buildSlug() }}"
                                                class="hover:font-bold @if (request()->is($page->buildSlug())) text-accent @endif">{{ str()->headline($page->name) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        </li>
                    @else
                        @foreach ($item->pages as $page)
                            <li><a href="/{{ $page->buildSlug() }}"
                                    class="hover:font-bold @if (request()->is($page->buildSlug())) text-accent @elseif($page->slug == 'home' && request()->is('/')) text-accent @endif">{{ str()->headline($page->name) }}</a>
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{--
                
                --}}
                @auth
                    <li><a href="{{ url('/admin') }}" target="_blank" class="hover:font-bold">
                            Admin
                        </a></li>
                    {{--
                @else
                    <li><a href="{{ route('login') }}">
                            Log in
                        </a></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">
                                Register
                            </a></li>
                    @endif
                    --}}
                @endauth
            </ul>
        </div>
        <div class="navbar-end">
            @livewire('partials.press-me')
        </div>
    </nav>
</header>
