<?php

namespace App\Http\Livewire\Person;

use Livewire\Component;
use App\Models\Marriage;
use App\Models\Person;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    public $person;
    public $children;
    public $father;
    public $mother;
    public $marriages;
    public $color;
    public $addMarriage = false;

    public $marriage = [
        'to' => null,
        'year' => null,
        'month' => null,
        'day' => null,
    ];
    protected $rules = [
        'person.first' => 'required|string|min:6',
        'person.middle_names' => 'string',
        'person.last' => 'required|string|min:6',
        'person.born_year' => 'integer',
        'person.born_month' => 'integer',
        'person.born_day' => 'integer',
        'person.born_circa' => 'boolean',
        'person.died_year' => 'integer',
        'person.died_month' => 'integer',
        'person.died_day' => 'integer',
        'person.father_id' => 'integer',
        'person.mother_id' => 'integer',
        'person.notes' => 'text'
    ];

    public function mount($id)
    {
        $this->person = Person::find($id);
        $this->children = Person::children($id)->get();
        $this->father = $this->person->getFather();
        $this->mother = $this->person->getMother();
        $this->marriages = Marriage::list($id);
        $this->color = 'blue';
    }

    public function updated($name, $value)
    {
        Log::debug(sprintf('Property: "%s" value: "%s"', $name, $value));
    }

    public function toggle()
    {
        Log::info(__METHOD__);
        $this->color = ($this->color == 'blue') ? 'white' : 'blue';
    }

    /**
     * 
     */
    public function toggleAddMarriage()
    {
        $this->addMarriage = ! $this->addMarriage;
    }

    /**
     * 
     */
    public function saveMarriage()
    {
        //($this->marriage);
        $marriage = new Marriage;
        if ( $this->person->gender == 'M' ) {
            $marriage->person1 = $this->person->id;
            $marriage->person2 = $this->marriage['to'];
        } else {
            $marriage->person2 = $this->person->id;
            $marriage->person1 = $this->marriage['to'];
        }
        $marriage->married_year = $this->marriage['year'];
        $marriage->married_month = $this->marriage['month'];
        $marriage->married_day = $this->marriage['day'];
        $marriage->save();
        $this->marriage = ['to' => null, 'year' => null, 'month' => null, 'day'];
        $this->marriages = Marriage::list($this->person->id);
        $this->toggleAddMarriage();
    }

    public function saveData()
    {
        Log::info(__METHOD__);
        $this->person->save();

        return redirect()->to("/persons/show/{$this->person->id}");
    }

    public function render()
    {
        $males = Person::where('gender', 'M')->select('id', 'first', 'middle_names', 'last')->get();
        $females = Person::where('gender', 'F')->select('id', 'first', 'middle_names', 'last')->get();
        $all = Person::select('id', 'first', 'middle_names', 'last')->get();
        return view('livewire.person.edit', compact('females', 'males', 'all'));
    }
}
