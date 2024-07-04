<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class PressMe extends Component
{

    public function pressMe()
    {
        $options = collect([
            "Quit it.",
            "Pack it in.",
            "Stop it."
        ]);
        $this->dispatch('alertBanner', data: [
            'status' => 'error',
            'statusMessage' => $options->random(),
        ])->to(AlertBanner::class);
    }
    public function render()
    {
        return view('livewire.partials.press-me');
    }
}
