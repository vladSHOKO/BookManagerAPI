<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'published_year',
        'pages',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope('owner', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filterName => $value) {
            $query->where($filterName, 'like', '%' . $value . '%');
        }

        return $query;
    }
}
