<?php

namespace App\Models;

class Role extends BaseModel
{
    protected $fillable = [
        'name',
        'level',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array'
    ];
}
