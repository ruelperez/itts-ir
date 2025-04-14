<?php

namespace App\Livewire\LinkForm;

use App\Models\Note;
use App\Models\User;
use Livewire\Component;

class LeaveForm extends Component
{
    public $authorizer, $page;

    public function render()
    {
        return view('livewire.link-form.leave-form');
    }

    public function mount($page){
       $this->page  = $page;
    }
}
