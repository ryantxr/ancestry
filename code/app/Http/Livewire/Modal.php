<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
class Modal extends Component
{
    public $title;
    public $show;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show()
    {
        Log::debug(__METHOD__);
        $this->show = true;
    }
    
    public function hide()
    {
        Log::debug(__METHOD__);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
