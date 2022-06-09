<?php

namespace App\Http\Livewire\Person;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Person;

class Create extends Component
{
    public $first;
    public $middleNames;
    public $last;
    public $altLast;
    public $suffix;
    public $nickname;
    public $title;
    public $sex;

    // Birth
    public $bornCirca; // Birth date is approximate
    public $bornYear; // can be null
    public $bornMonth; // can be null
    public $bornDay; // can be null
    public $bornWhere; // can be country, city or whatever

    // Died
    public $diedCirca; // Birth date is approximate
    public $diedYear; // can be null
    public $diedMonth; // can be null
    public $diedDay; // can be null
    public $diedWhere; // can be country, city or whatever

    public $fatherId;
    public $motherId;

    public $notes;

    public function updated($name, $value)
    {
        Log::debug(sprintf('Property: "%s" value: "%s"', $name, $value));
    }

    public function save()
    {
        Log::debug(__METHOD__);
        $data = [
            'first' => $this->first,
            'middle_names' => $this->middleNames,
            'last' => $this->last,
            'alt_last' => $this->altLast,
            'suffix' => $this->suffix,
            'nickname' => $this->nickname,
            'title' => $this->title,
            'gender' => $this->sex,
            'born_circa' => $this->bornCirca ? 1 : 0,
            'born_year' => empty($this->bornYear) ? null : $this->bornYear,
            'born_month' => empty($this->bornMonth) ? null :$this->bornMonth,
            'born_day' => empty($this->bornDay) ? null : $this->bornDay,
            'born_where' => $this->bornWhere,
            // 'died_circa' => $this->diedCirca,
            'died_year' => $this->diedYear,
            'died_month' => $this->diedMonth,
            'died_day' => $this->diedDay,
            'died_where' => $this->diedWhere,
            'notes' => $this->notes,
            'father_id' => $this->fatherId,
            'mother_id' => $this->motherId,
        ];
        $json = json_encode($data);
        Log::debug($json);
        $p = new Person();
        $id = $p->insertGetId($data);
        Log::info("Inserted $id");
        return redirect()->to('/persons');
    }

    public function render()
    {
        $males = Person::where('gender', 'M')->select('id', 'first', 'middle_names', 'last')->get();
        $females = Person::where('gender', 'F')->select('id', 'first', 'middle_names', 'last')->get();
        // $names = array_map(function($item){
        //     return sprintf('%d %s %s %s', $item['id'], $item['first'], $item['middle_names'], $item['last']);
        // }, $all);
        return view('livewire.person.create', compact('females', 'males'));
    }
}
