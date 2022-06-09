<?php

namespace App\Http\Livewire\Person;

use Livewire\Component;
use App\Models\Marriage;
use App\Models\Person;
class Show extends Component
{
    public $person;
    public $children;
    public $father;
    public $mother;
    public $marriages;

    public function mount($id)
    {
        $this->person = Person::find($id);
        $this->children = Person::children($id)->get();
        $this->father = $this->person->getFather();
        $this->mother = $this->person->getMother();
        $this->marriages = Marriage::list($id);
    }

    public function render()
    {
        return view('livewire.person.show');
    }
}
