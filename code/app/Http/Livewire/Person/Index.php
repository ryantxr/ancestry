<?php

namespace App\Http\Livewire\Person;

use Livewire\Component;
use App\Models\Person;

class Index extends Component
{
    public $persons = [];
    public $search;

    public function mount()
    {
        $this->persons = $this->query();
    }

    public function updatedSearch()
    {
        $this->persons = $this->query($this->search); 
    }

    public function render()
    {
        return view('livewire.person.index');
    }

    protected function query($search = null)
    {
        if ( $search ) {
            $searchResults = Person::where('last', 'like', $search . '%')
                ->orWhere('first', 'like', $search . '%')
                ->get();
            return $searchResults;
        }
        return Person::all();
    }
}
