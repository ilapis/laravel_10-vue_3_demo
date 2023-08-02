<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Article extends Model
{
    use HasFactory, HasFilter, SoftDeletes;

    protected $fillable = [
        'text',
        'language_id',
        'title',
        'tags',
        'user_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected array $dates = ['deleted_at'];
}
