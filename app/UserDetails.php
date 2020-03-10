<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    /**
     * Table name
     */
    protected $table = 'user_details';

    /**
     * Timestamps
     */
    public $timestamps = false;

    /**
     * Relationship Users / UserDetails
     */
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
