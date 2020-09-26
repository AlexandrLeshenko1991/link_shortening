<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function statistics()
    {
        return $this->hasMany(StatisticLinks::class);
    }
}
