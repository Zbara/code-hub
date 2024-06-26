<?php

namespace App\Models\Post;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'slug',
    ];

    /**
     * Relationships to user model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Filters the query
     */
    public function scopeFilter(
        Builder $query,
        array $filters
    ): void {
        $query->when(isset($filters['created_at']), function ($query) use ($filters) {
            $query->whereDate('created_at', Carbon::parse($filters['created_at'].'f45'));
        });
    }
}
