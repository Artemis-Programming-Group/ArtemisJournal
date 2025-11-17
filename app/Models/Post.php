<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'reading_time',
        'status',
        'price',
        'old_price',
        'user_id'
    ];

    protected $casts = [
        'price' => 'integer',
        'old_price' => 'integer',
    ];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'model_has_tag');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function relatedPosts($limit = 4)
    {
        return Post::whereHas('tags', function ($query) {
            $query->whereIn('tags.id', $this->tags->pluck('id'));
        })
            ->where('id', '!=', $this->id)
            ->published()
            ->limit($limit)
            ->get();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDrafts($query)
    {
        return $query->where('status', 'draft');
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->old_price) return 0;
        return round((($this->old_price - $this->price) / $this->old_price) * 100);
    }
}
