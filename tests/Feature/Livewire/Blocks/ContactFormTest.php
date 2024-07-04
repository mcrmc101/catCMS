<?php

namespace Tests\Feature\Livewire\Blocks;

use App\Livewire\Blocks\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ContactForm::class)
            ->assertStatus(200);
    }
}
