<?php

namespace App\Models;

use App\Traits\HasPostMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;


class Post extends Model implements Feedable
{
    use HasFactory, HasPostMeta;

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
                $post->slug = createPersianSlug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = createPersianSlug($post->title);
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

    /**
     * Convert a single post to a feed item.
     */
    public function toFeedItem(): FeedItem
    {
        $url = route('post-details', $this->slug);

        return FeedItem::create()
            ->id($url) // this becomes <guid>
            ->title($this->title)
            ->summary($this->seo_description)
            ->updated($this->updated_at ?? $this->created_at)
            ->link($url)
            ->authorName($this->user->name);
    }

    /**
     * Items that will appear in the feed.
     */
    public static function getFeedItems()
    {
        return static::published()
            ->latest()
            ->limit(50)
            ->get();
    }
}
