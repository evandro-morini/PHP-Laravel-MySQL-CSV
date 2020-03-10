<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /**
     * Table name
     */
    protected $table = 'transactions';

    /**
     * Attributes that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['id', 'code', 'amount', 'user_id'];

    /**
     * Dates declaration
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
