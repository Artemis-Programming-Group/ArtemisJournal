@props(['post'])

@php
    // Normalize / prepare values
    $title = $post->seo_title;

    // Remove extra newlines / spaces from description
    $description = \Illuminate\Support\Str::of($post->seo_description)->squish();

    $canonical = $post->seo_canonical;
    $ogImage   = $post->seo_og_image; // should already be absolute URL from trait

    // Keywords: prefer meta, fallback to tags
    $keywords = $post->getMeta('seo_keywords')
        ?: $post->tags->pluck('name')->implode(', ');
@endphp


{{-- Basic meta --}}
<meta name="description" content="{{ $description }}">

@if(!empty($keywords))
    <meta name="keywords" content="{{ $keywords }}">
@endif

<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph --}}
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $post->seo_og_title }}">
<meta property="og:description" content="{{ $post->seo_og_description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:locale" content="fa_IR">
<meta property="og:site_name" content="Artemis Journal">
@if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
@endif

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->getMeta('seo_twitter_title', $title) }}">
<meta name="twitter:description" content="{{ $post->getMeta('seo_twitter_description', $description) }}">
@if($ogImage)
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif

@php
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $title,
        'description' => $description,
        'image' => $ogImage,
        'datePublished' => optional($post->created_at)->toIso8601String(),
        'dateModified' => optional($post->updated_at ?? $post->created_at)->toIso8601String(),
        'inLanguage' => 'fa-IR',
        'author' => [
            '@type' => 'Person',
            'name' => $post->user->name ?? 'ناشناخته',
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $canonical,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Artemis Journal',
        ],
    ];

    if (!empty($keywords)) {
        $jsonLd['keywords'] = $keywords;
    }
@endphp

<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
