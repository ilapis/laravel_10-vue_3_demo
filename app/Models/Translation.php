<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'language_id',
        'key',
        'value',
    ];

    /**
     * @return BelongsTo<Language, Translation>
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
