<?php

namespace App\Livewire\Blocks;

use Livewire\Component;

class CarouselBlock extends Component
{
    public $contents;

    public $contentsCount;

    public function mount()
    {
        $this->contentsCount = count($this->contents);
    }

    public function render()
    {
        return view('livewire.blocks.carousel-block');
    }
}
