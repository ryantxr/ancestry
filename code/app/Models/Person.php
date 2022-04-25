<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';


    public function scopeChildren($query, $id)
    {
        return $query
            ->where('father_id', $id)
            ->orWhere('mother_id', $id)
            ->orderBy('born_year');
    }

    public function getFather()
    {
        return $this->where('id', $this->father_id)->first();
    }

    public function getMother()
    {
        return $this->where('id', $this->mother_id)->first();
    }

    public function getFullNameAttribute()
    {
        $middleNames = $this->middle_names;
        if ( ! empty($this->nickname) ) {
            $nick = trim($this->nickname);
            if ( ! empty($this->middle_names) ) {
                $mnames = explode(" ", $this->middle_names);
                $found = false;
                foreach ( $mnames as $i => $mn ) {
                    $mn = trim($mn);
                    if ( strtolower($mn) == strtolower($nick) ) {
                        $mnames[$i] = '"' . $mn . '"';
                        $found = true;
                        break;
                    }
                }
                if ( $found ) {
                    $middleNames = implode(' ', $mnames);
                } else {
                    array_unshift($mnames, '"'  . $nick . '"');
                    $middleNames = implode(' ', $mnames);
                }
            } else {
                // Have a nick name but no middle names
                $middleNames = '"'  . $nick . '"';
            }
        }
        // $nick = ( $this->nickname ) ? sprintf(' "%s"', $this->nickname) : null;
        return sprintf('%s %s %s', $this->first, $middleNames, $this->last);
    }

    public function getBornAttribute()
    {
        $str = '';
        if ( $this->born_circa ) {
            $str .= 'circa ';
        }
        if ( $this->born_day ) {
            $c = Carbon::create(2000, 1, $this->born_day);
            $str .= $c->format('jS ');
        }
        if ( $this->born_month ) {
            $c = Carbon::create(2000, $this->born_month, 1);
            $str .= $c->format('F ');
        }
        $str .= $this->born_year;
        return $str;
    }

    public function getDiedAttribute()
    {
        $str = '';
        if ( $this->died_day ) {
            $c = Carbon::create(2000, 1, $this->died_day);
            $str .= $c->format('jS ');
        }
        if ( $this->died_month ) {
            $c = Carbon::create(2000, $this->died_month, 1);
            $str .= $c->format('F ');
        }
        $str .= $this->died_year;
        return $str;
    }

    public function getDeathAgeAttribute()
    {
        if ( ! $this->born_year || ! $this->died_year ) {
            return null;
        }
        return $this->died_year - $this->born_year;
    }
}
