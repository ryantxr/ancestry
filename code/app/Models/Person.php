<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';

    /**
     * 
     */
    public function scopeChildren($query, $id)
    {
        return $query
            ->where('father_id', $id)
            ->orWhere('mother_id', $id)
            ->orderBy('born_year');
    }

    /**
     * 
     */
    public function scopeFindUuid($q, $uuid)
    {
        return $q->where('uuid', $uuid);
    }

    /**
     * 
     */
    public function getFather()
    {
        return $this->where('id', $this->father_id)->first();
    }

    /**
     * 
     */
    public function getMother()
    {
        return $this->where('id', $this->mother_id)->first();
    }

    /**
     * 
     */
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

    /**
     * dynamic attribute when person was born
     */
    public function getBornAttribute() : string
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
            $str .= $c->format('M ');
        }
        $str .= $this->born_year;
        return $str;
    }

    /**
     * Returns a string describing the person's age span.
     * i.e. from - to
     * @return string
     */
    public function getAgeSpanAttribute() : string
    {
        $str = '';
        if ( $this->born_circa ) {
            $str .= 'circa ';
        }
        $sep = null;
        if ( $this->born_year )
        {
            $str .= $this->born_year;
            $sep = ' - ';
        }
        if ( $this->died_year ) {
            $str .= $sep . $this->died_year;
        }
        return $str;
    }

    /**
     * Return a string describing when the person died.
     * Might just be a year or month/year or a full date
     * @return string
     */
    public function getDiedAttribute() : string
    {
        $str = '';
        if ( $this->died_day ) {
            $c = Carbon::create(2000, 1, $this->died_day);
            $str .= $c->format('jS ');
        }
        if ( $this->died_month ) {
            $c = Carbon::create(2000, $this->died_month, 1);
            $str .= $c->format('M ');
        }
        $str .= $this->died_year;
        return $str;
    }
    /**
     * How old was the person when they died
     * Returns null if we don't know when they died.
     * @return ?int 
     */
    public function getDeathAgeAttribute() : ?int
    {
        if ( ! $this->born_year || ! $this->died_year ) {
            return null;
        }
        return $this->died_year - $this->born_year;
    }
}
