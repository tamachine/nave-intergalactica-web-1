<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $types;

    public function mount($types)
    {
        $this->types = $types;
    }
    
    public function render()
    {
        return view('livewire.contact-form');
    }

}
