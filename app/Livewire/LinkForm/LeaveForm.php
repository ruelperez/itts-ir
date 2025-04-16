<?php

namespace App\Livewire\LinkForm;

use App\Models\Note;
use App\Models\User;
use App\Rules\Base64Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class LeaveForm extends Component
{
    use WithFileUploads;

    public $start, $end, $numOfDays, $leaveType, $user_id, $reason, $isEmergency = "NO", $name, $fullname, $address, $phoneNum, $relationship;
    public $signature;
    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->fullname = auth()->user()->fullname;
        return view('livewire.link-form.leave-form');
    }

    #[On('setSignature')]
    public function setSignature($data)
    {
        $this->signature = $data;
        $this->submit();
    }
    public function submit()
    {
        $validatedData = $this->validate([
            'signature'   => 'required'
        ]);

        $imageData = $this->signature; // This is the base64 data of the signature
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image); // Ensure the base64 string is properly formatted
        $imageName = 'signature_' . time() . '.png';
        $imagePath = public_path('storage/signatures/' . $imageName);

// Save the image to the public directory
        file_put_contents($imagePath, base64_decode($image)); // Decodes and writes the file



        // Save data in the database (for example in LeaveRequest model)
        \App\Models\LeaveForm::create([
            'user_id' => $this->user_id,
            'start' => $this->start,
            'end' => $this->end,
            'numOfDays' => $this->numOfDays,
            'leaveType' => $this->leaveType,
            'reason' => $this->reason,
            'signature' => 'storage/signatures/' . $imageName, // Save the relative path to the signature image
        ]);

        $this->dispatch('success');
    }

    public function clear()
    {
        // Clear all fields
        $this->reset();
    }
}
