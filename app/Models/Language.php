<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'code',
        'name',
        'enabled',
    ];
}
