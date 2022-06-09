<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Person;

class PersonFillUuid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'person:uuid:fill {--id=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $id = $this->option('id');
        $force = $this->option('force');
        if ( $id ) {
            $this->one($id);
        } else {
            $this->all($force);
        }
        return 0;
    }
    
    public function all($force)
    {
        $list = Person::all();
        foreach ( $list as $person ) {
            $this->update($person, $force);
        }
    }

    public function one($id)
    {
        $person = Person::find($id);
        $this->update($person, true);
    }

    public function update(Person $person, bool $override=false)
    {
        if ( empty($person->uuid) || $override ) {
            $first = strtolower(substr(trim($person->first), 0, 1));
            $last = strtolower(preg_replace('/[^A-Za-z]/', '', trim($person->last)));
            $person->uuid = $last;
            // if ( ! empty($person->middle_names) ) {
            //     $person->uuid .= '-' . strtolower(trim(str_replace(' ', '', $person->middle_names)));
            // }
            $person->uuid .= '-' . $first;
            $temp = preg_replace('/^([^-]+)-.*$/', '$1', Str::uuid());
            // $temp = substr($temp, 0, strpos($temp, '-'));
            // $temp = substr(md5($last . '-' . $first), 0, 6);
            $person->uuid .= '-' . $temp;
            $this->line(sprintf("Update %s %s uuid to %s", $person->first, $person->last, $person->uuid));
            $person->save();
        }
    }
}
