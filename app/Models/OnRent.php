<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnRent extends Model
{
    protected $table = 'onrent';

    public function onrentLines()
    {
        return $this->hasMany(OnRentLines::class, 'onrent_id');
    }

    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->generated_at)->format('d/m/Y');
    }
}
