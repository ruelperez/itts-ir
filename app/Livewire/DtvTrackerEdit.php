<?php

namespace App\Livewire;

use Livewire\Component;

class DtvTrackerEdit extends Component
{
    public $ids, $customer, $phoneNumber, $altPhoneNumber, $email, $address, $service, $package, $disposition, $result, $description, $orderNumber, $date, $agent, $coach;
    public function render()
    {
        return view('livewire.dtv-tracker-edit');
    }

    public function mount($id){
        $this->ids = $id;
        $dv = \App\Models\DtvTracker::find($this->ids);
        $this->customer = $dv->name;
        $this->phoneNumber = $dv->phone_num;
        $this->altPhoneNumber = $dv->alt_num;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->service = $dv->service;
        $this->package = $dv->package;
        $this->disposition = $dv->disposition;
        $this->result = $dv->result;
        $this->description = $dv->description;
        $this->orderNumber = $dv->orderNumber;
        $this->date = $dv->date;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
    }
}
