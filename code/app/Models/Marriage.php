<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Marriage extends Model
{
    use HasFactory;
    protected $table = 'marriage';

    static public function list($id)
    {
        return (new static)
            ->where('person1', $id)
            ->orWhere('person2', $id)
            ->orderBy('married_year')->get();
    }

    public function getDateAttribute()
    {
        if ( ! $this->married_year ) return null;
        if ( $this->married_year && $this->married_month && $this->married_day ) {
            // We have year month and day
            return Carbon::create($this->married_year, $this->married_month, $this->married_day)->format('jS F Y');
        }
        if ( $this->married_year && $this->married_month ) {
            // We have year month and day
            return Carbon::create($this->married_year, $this->married_month, 1)->format('F Y');
        }
        return $this->married_year;
    }

    public function spouse($id)
    {
        $spouseId = ( $id == $this->person1 ) ? $this->person2 : $this->person1;
        // dd($spouseId);
        $p = Person::find($spouseId);
        // dd($p);
        return  $p;
    }
}
