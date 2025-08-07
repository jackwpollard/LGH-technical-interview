<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnRentLines extends Model
{
    protected $table = 'onrent_lines';

    public function onrent()
    {
        return $this->belongsTo(OnRent::class, 'onrent_id');
    }
}
