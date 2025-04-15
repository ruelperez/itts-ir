<?php

namespace App\Livewire\LinkForm;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LeaveForm extends Component
{
    public $authorizer, $page;
    public string $signature = '';

    public function render()
    {
        return view('livewire.link-form.leave-form');
    }

    public function mount($page){
       $this->page  = $page;
    }

    public function submit()
    {
        $this->validate([
            // other validations...
            'signature' => 'required|string',
        ]);

        // Save form data and $this->signature (base64 image)
        // You can store it as a string in the database or convert it to a file

        // Example: store as file
        $image = str_replace('data:image/png;base64,', '', $this->signature);
        $image = str_replace(' ', '+', $image);
        $imageName = 'signature_' . now()->timestamp . '.png';
        Storage::disk('public')->put("signatures/{$imageName}", base64_decode($image));

        // Save to DB (optional)
        // LeaveForm::create([... , 'signature_path' => "signatures/{$imageName}"]);

        $this->dispatch('subSubmitted');
        session()->flash('message', 'Leave request submitted successfully!');
    }
}
