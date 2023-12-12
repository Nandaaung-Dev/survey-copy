<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Township extends Model
{
    use HasFactory, HasUlids;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function quarters()
    {
        return $this->hasMany(Quarter::class);
    }
}
