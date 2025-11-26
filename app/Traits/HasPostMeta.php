<?php

namespace App\Traits;

use App\Models\PostMeta;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPostMeta
{
    public function meta(): HasMany
    {
        return $this->hasMany(PostMeta::class);
    }

    public function getMeta(string $key, $default = null): ?string
    {
        if ($this->relationLoaded('meta')) {
            $meta = $this->meta->firstWhere('key', $key);
            return $meta?->value ?? $default;
        }

        return $this->meta()
            ->where('key', $key)
            ->value('value') ?? $default;
    }

    public function setMeta(string $key, $value): self
    {
        $this->meta()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        if ($this->relationLoaded('meta')) {
            $this->load('meta');
        }

        return $this;
    }

    public function forgetMeta(string $key): self
    {
        $this->meta()->where('key', $key)->delete();

        if ($this->relationLoaded('meta')) {
            $this->setRelation(
                'meta',
                $this->meta->reject(fn($item) => $item->key === $key)
            );
        }

        return $this;
    }

    /* ========= SEO Accessors ========== */

    public function getSeoTitleAttribute(): string
    {
        return $this->getMeta('seo_title', $this->title);
    }

    public function getSeoDescriptionAttribute(): string
    {
        $fallback = $this->excerpt ?: Str::limit(strip_tags($this->content), 160);
        return Str::of($this->getMeta('seo_description', $fallback))->squish();
    }

    public function getSeoCanonicalAttribute(): string
    {
        return $this->getMeta('seo_canonical', route('post-details', $this->slug));
    }

    public function getSeoOgTitleAttribute(): string
    {
        return $this->getMeta('seo_og_title', $this->seo_title);
    }

    public function getSeoOgDescriptionAttribute(): string
    {
        return $this->getMeta('seo_og_description', $this->seo_description);
    }

    public function getSeoOgImageAttribute(): ?string
    {
        $path = $this->getMeta('seo_og_image', $this->featured_image);

        if (!$path) {
            return null;
        }

        return url($path);
    }
}
