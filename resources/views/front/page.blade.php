<x-guest-layout>
    @push('head')
        {!! seo()->for($page) !!}
    @endpush
    <div class="container mx-auto fade-in">
        @foreach ($page->content as $content)
            @if ($content['type'] == 'Image Block')
                @include('front.blocks.image-block', [
                    'contents' => $content['data']['Blocks'],
                ])
            @elseif ($content['type'] == 'Carousel')
                @livewire('blocks.carousel-block', [
                    'contents' => $content['data']['Tiles'],
                ])
            @elseif ($content['type'] == 'Contact Form')
                @livewire('blocks.contact-form')
            @else
                @foreach ($content['data'] as $data)
                    <div class="prose max-w-none prose-figure:justify-center mx-auto my-12 md:w-3/4 "
                        x-data="{ inView: false }" x-intersect="inView = true" :class="{ 'slide-in-bottom': inView }">
                        {!! $data !!}
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</x-guest-layout>
