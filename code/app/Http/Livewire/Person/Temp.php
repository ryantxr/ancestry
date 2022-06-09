<?php

namespace App\Http\Livewire\Person;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Temp extends Component
{
    public $temp;
    public $show;

    
    public function mount()
    {
        $this->show = true;
        $this->temp = 'Hurricane';
    }
    public function toggle()
    {
        Log::info(__METHOD__);
        $this->show =  ! $this->show;
    }

    public function render()
    {
        return view('livewire.person.temp');
    }
}
