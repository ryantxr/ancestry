<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;

class PersonLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'person:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load a sub tree from a json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = app_path('../../person.json');
        // dd($file);
        if ( ! file_exists($file) ) {
            $this->error("$file not found");
            return 1;
        }
        $object = json_decode(file_get_contents($file));
        foreach ( $object->person_list as $p ) {
            $person = Person::findUuid($p->ref)->first();
            if ( $person ) {
                $this->line("found " . $person->first . ' ' . $person->last);
            } else {
                $person = new Person();
                $person->uuid = $p->ref;
                $person->first = $p->first;
                $person->last = $p->last;
                $person->middle_names = $p->middle;
                $person->suffix = $p->suffix;
                $person->nickname = $p->nickname;
                $person->title = $p->title;
                $person->gender = $p->gender;
                $person->notes = $p->notes;
                
                // birth
                $person->born_year = $p->born->year;
                $person->born_month = $p->born->month;
                $person->born_day = $p->born->day;
                $person->born_where = $p->born->where;
                
                // death
                $person->died_year = $p->died->year;
                $person->died_month = $p->died->month;
                $person->died_day = $p->died->day;
                $person->died_where = $p->died->where;
                $person->buried_where = $p->died->buried;

                if ( substr($p->father_ref, 0, 4) == 'ref:' ) {
                    $uuid = substr($p->father_ref, 4);
                    $father = Person::findUuid($uuid)->first();
                } else {
                    $father = Person::find($p->father_ref);
                }
                $person->father_id = $father ? $father->id : null;
                if ( substr($p->mother_ref, 0, 4) == 'ref:' ) {
                    $uuid = substr($p->mother_ref, 4);
                    $mother = Person::findUuid($uuid)->first();
                } else {
                    $mother = Person::find($p->mother_ref);
                }
                $person->mother_id = $mother ? $mother->id : null;

                dump($person->toArray());
                $person->save();
            }
        }
        return 0;
    }
}
