<div class="flex items-start justify-evenly my-6 md:w-3/4 mx-auto" x-data="{ inView: false }" x-intersect="inView = true"
    :class="{ 'slide-in-bottom': inView }">
    @foreach ($contents as $content)
        <a href="{{ $content['link'] }}" target="_blank" class="my-6">
            <img src="{{ asset('storage/' . $content['url']) }}" alt="{{ $content['alt'] }}" class="mx-auto h-44">
            <div class="prose text-center">
                {!! $content['text-content'] !!}
            </div>
        </a>
    @endforeach
</div>
