<div wire:ignore class="swiper h-screen">
    <div class="swiper-wrapper items-center">
        @if ($contentsCount > 1)
            @foreach ($contents as $content)
                <div class="swiper-slide" wire:key="carousel-item-{{ $content['url'] }}">
                    <div class="hero h-full bg-center"
                        style="background-image: url({{ asset('storage/' . $content['url']) }});">
                        <div class="hero-overlay bg-opacity-20"></div>
                        <div class="hero-content h-fit w-full items-start justify-start text-neutral-50">
                            <div class="ml-8 prose prose-lg text-inherit prose-headings:text-inherit prose-img:mx-auto slide-text-content text-shadow"
                                x-data="{ inView: false }" x-intersect="inView = true"
                                :class="{ 'slide-in-bottom': inView }">
                                {!! $content['Text'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="hero h-full bg-center"
                style="background-image: url({{ asset('storage/' . $contents[0]['url']) }});">
                <div class="hero-overlay bg-opacity-20"></div>
                <div class="hero-content h-fit w-full items-start justify-start text-neutral-50">
                    <div class="ml-8 prose prose-lg text-inherit prose-headings:text-inherit prose-img:mx-auto slide-text-content text-shadow"
                        x-data="{ inView: false }" x-intersect="inView = true" :class="{ 'slide-in-bottom': inView }">
                        {!! $contents[0]['Text'] !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@if ($contentsCount > 1)
    @script
        <script>
            const swiper = new Swiper('.swiper', {
                direction: 'horizontal',
                loop: true,
                autoplay: {
                    delay: 15000,
                },
                speed: 400,
                observer: true,
                observeParents: true,
                coverflowEffect: {
                    slideShadows: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            });

            function animateSlide(swiper) {
                const activeSlide = swiper.slides[swiper.activeIndex];
                const content = activeSlide.querySelector('.slide-text-content');
                if (content) {
                    content.classList.remove('slide-in-bottom');
                    // Force a reflow
                    void content.offsetWidth;
                    content.classList.add('slide-in-bottom');
                }
            }

            swiper.on('slideChange', function() {
                animateSlide(swiper);
            });

            // Initial animation
            animateSlide(swiper);
        </script>
    @endscript
@endif
