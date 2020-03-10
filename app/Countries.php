<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    /**
     * Table name
     */
    protected $table = 'countries';

    /**
     * Timestamps
     */
    public $timestamps = false;

    /**
     * Relationship UserDetails / Countries
     */
    public function userDetails()
    {
        return $this->belongsTo(UserDetails::class);
    }
}
