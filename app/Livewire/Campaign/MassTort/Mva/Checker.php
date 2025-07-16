<?php

namespace App\Livewire\Campaign\MassTort\Mva;

use Livewire\Component;

class Checker extends Component
{
    public $search = '';
    public $formData = [];
    public $errorMessage = '';

    public $questions = [
        'Date of Accident',
        'Treatment Window (Initial)',
        'Driver Not At Fault',
        'Attorney or Change in Representation',
        'No Moving Violation',
        'No Prior Injury Settlement',
        'Insurance Coverage (At Least One Required)',
        'Real Injuries (Not Minor)',
        'No Lapse in Treatment >30 Days',
        'Police Called to Scene',
        'Report Other Party at Fault',
        'Vehicle Types Covered',
        'Liability Cases',
        'Treatment Types Accepted',
        'Passengers Accepted',
        'OBO (On Behalf Of) Cases',
        'Language Support',
        'Minor (Under 18)',
    ];

    public $dateOfAccidentOptions = [];
    public $treatmentWindowOptions = [];
    public $yesNoOptions = ['Yes', 'No', 'Not Specified'];

    public function mount()
    {
        $this->dateOfAccidentOptions = array_unique([
            'Within past 6 months',
            'Within 20 months',
            'Within 20 months',
            'Within 1 year',
            'Within 30 days'
        ]);

        $this->treatmentWindowOptions = array_unique([
            'Within 14 days',
            'Within 30 days',
            'Within 7 days or willing to treat',
            'Within 30 days',
            'Within 14 days'
        ]);
    }

    public function selectOption($index, $option)
    {
        $this->formData[$index] = $option;
    }

    public function validateForm()
    {
        $this->errorMessage = '';

        // Check if all questions are answered
        foreach ($this->questions as $index => $question) {
            if (empty($this->formData[$index])) {
                $this->errorMessage = 'Please answer all questions before submitting.';
                return false;
            }
        }

        return true;
    }

    public function submit()
    {
        if ($this->validateForm()) {
            // All required, safe to submit

            if ($this->formData[0] == "Within past 6 months" && $this->formData[1] == "Within 14 days") {

                // Check remaining questions (index 2 to last)
                $allYes = true;
                foreach ($this->questions as $index => $question) {
                    if ($index >= 2) {
                        if (($this->formData[$index] ?? null) !== 'Yes') {
                            $allYes = false;
                            break;
                        }
                    }
                }

                if ($allYes) {
                    $this->dispatch('show-qualified-status');
                }
                else{
                    $this->dispatch('show-disqualified-status');
                }
            }
            elseif ($this->formData[0] == "Within 20 months" && $this->formData[1] == "Within 30 days"){
                // Check remaining questions (index 2 to last)
                $allYes = true;
                foreach ($this->questions as $index => $question) {
                    if ($index >= 2) {
                        if (($this->formData[$index] ?? null) !== 'Yes') {
                            $allYes = false;
                            break;
                        }
                    }
                }

                if ($allYes) {
                    $this->dispatch('show-qualified-status');
                }
                else{
                    $this->dispatch('show-disqualified-status');
                }
            }
            elseif ($this->formData[0] == "Within 20 months" && $this->formData[1] == "Within 7 days or willing to treat"){
                // Check remaining questions (index 2 to last)
                $allYes = true;
                foreach ($this->questions as $index => $question) {
                    if ($index >= 2) {
                        if (($this->formData[$index] ?? null) !== 'Yes') {
                            $allYes = false;
                            break;
                        }
                    }
                }

                if ($allYes) {
                    $this->dispatch('show-qualified-status');
                }
                else{
                    $this->dispatch('show-disqualified-status');
                }
            }
            elseif ($this->formData[0] == "Within 1 year" && $this->formData[1] == "Within 30 days"){
                // Check remaining questions (index 2 to last)
                $allYes = true;
                foreach ($this->questions as $index => $question) {
                    if ($index >= 2) {
                        if (($this->formData[$index] ?? null) !== 'Yes') {
                            $allYes = false;
                            break;
                        }
                    }
                }

                if ($allYes) {
                    $this->dispatch('show-qualified-status');
                }
                else{
                    $this->dispatch('show-disqualified-status');
                }
            }
            elseif ($this->formData[0] == "Within 30 days" && $this->formData[1] == "Within 14 days"){
                // Check remaining questions (index 2 to last)
                $allYes = true;
                foreach ($this->questions as $index => $question) {
                    if ($index >= 2) {
                        if (($this->formData[$index] ?? null) !== 'Yes') {
                            $allYes = false;
                            break;
                        }
                    }
                }

                if ($allYes) {
                    $this->dispatch('show-qualified-status');
                }
                else{
                    $this->dispatch('show-disqualified-status');
                }
            }
            else{
                $this->dispatch('show-disqualified-status');
            }
        }
    }


    public function render()
    {
        return view('livewire.campaign.mass-tort.mva.checker');
    }
}
