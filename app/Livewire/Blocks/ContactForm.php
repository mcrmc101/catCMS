<?php

namespace App\Livewire\Blocks;

use App\Livewire\Partials\AlertBanner;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ContactForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')

                    ->maxLength(255),
                Forms\Components\TextInput::make('business')
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull()->autosize(),
            ])->columns(2)
            ->statePath('data')
            ->model(Contact::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Contact::create($data);

        $this->form->model($record)->saveRelationships();
        $this->form->fill();
        $this->dispatch('alertBanner', data: [
            'status' => 'success',
            'statusMessage' => "Thanks for your message. We'll be in touch soon.",
        ])->to(AlertBanner::class);
    }

    public function render(): View
    {
        return view('livewire.blocks.contact-form');
    }
}
