<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Language extends Model
{
    use HasFactory, HasFilter, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'enabled',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected array $dates = ['deleted_at'];

    protected static function booted()
    {
        static::deleting(function ($language) {
            if ($language->articles()->count() > 0) {
                return false;
            }
        });
    }

    public function articles(): hasMany
    {
        return $this->hasMany(Article::class);
    }
}
