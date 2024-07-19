<div class="grid grid-cols-2 my-12">
    <div class="p-4">
        <x-filament::section class="w-full h-full">
            <x-slot name="heading">
                Contact Us
            </x-slot>
            <form wire:submit="create" x-data="{ inView: false }" x-intersect="inView = true"
                :class="{ 'slide-in-bottom': inView }">
                {{ $this->form }}

                <button type="submit" class="w-full btn btn-primary mt-6">
                    Submit
                </button>
            </form>

            <x-filament-actions::modals />
        </x-filament::section>
    </div>
    <div class="p-4 flex flex-col gap-4">
        <x-filament::section class="w-full h-full">
            <x-slot name="heading">
                Find Us
            </x-slot>
            <div x-data="{ inView: false }" x-intersect="inView = true" :class="{ 'slide-in-bottom': inView }">
                <iframe class="h-1/2 w-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3251.9645700122683!2d86.92391881953573!3d27.98844480423172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e854a215bd9ebd%3A0x576dcf806abbab2!2sMt%20Everest!5e0!3m2!1sen!2suk!4v1720020166469!5m2!1sen!2suk"
                    width="auto" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="flex prose max-w-none items-start gap-4">
                    <div>
                        <dl>
                            <dt>Address</dt>
                            <dd>10 That Street</dd>
                            <dd>Some Town</dd>
                            <dd>Over There</dd>
                        </dl>
                    </div>
                    <div>
                        <dl>
                            <dt>Phone</dt>
                            <dd>0898 123 123</dd>
                        </dl>
                    </div>
                    <div>
                        <dl>
                            <dt>Email</dt>
                            <dd>test@test.test</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </x-filament::section>
    </div>
</div>
