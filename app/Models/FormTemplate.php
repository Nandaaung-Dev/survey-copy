<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'content',
    ];
    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    protected $casts = [
        'content' => 'array',
    ];
}
