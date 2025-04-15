<?php

namespace App\Livewire\LinkForm;

use App\Models\Note;
use App\Models\User;
use App\Rules\Base64Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LeaveForm extends Component
{
    public $start, $name, $address, $fullname, $phoneNum, $relationship, $end, $numOfDays, $isEmergency = "NO", $leaveType, $reason, $signature, $page;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        return view('livewire.link-form.leave-form');
    }

    public function mount($page){
       $this->page  = $page;
    }

    // Handle form submission
    public function submit()
    {
//        $this->validate([
//            'start' => 'required|date',
//            'end' => 'required|date',
//            'numOfDays' => 'required|numeric',
//            'leaveType' => 'required|string',
//            'reason' => 'required|string',
//            'signature' => ['required', new Base64Image],
//        ]);
        if (!$this->signature) {
            $this->dispatch('signature-missing');
            return;
        }

        $signaturePath = null;
        if ($this->signature) {
            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->signature)));
            $signaturePath = $fileName;
        }

        LeaveForm::create([
            'start' => $this->start,
            'end' => $this->end,
            'num_of_days' => $this->numOfDays,
            'leave_type' => $this->leaveType,
            'reason' => $this->reason,
            'signature' => $signaturePath,
            'is_emergency' => $this->isEmergency,
            'name' => $this->name,
            'address' => $this->address,
            'phone_num' => $this->phoneNum,
            'relationship' => $this->relationship,
        ]);

        session()->flash('message', 'Leave form submitted successfully!');
        $this->reset();
    }

    public function clear()
    {
        $this->reset();
    }
}
