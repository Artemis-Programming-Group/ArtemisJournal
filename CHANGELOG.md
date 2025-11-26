# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---


## [1.4.0] - 2025-11-26

### Added
- Basic PWA support with `public/manifest.webmanifest`.
- Service worker at `public/service-worker.js` to:
  - Pre-cache home, manifest, and offline page.
  - Provide offline fallback for HTML requests.
  - Cache static assets with a cache-first strategy.
- Offline fallback page at `resources/views/offline.blade.php`.
- Route `/offline` for showing a friendly offline message.
- PWA-related meta tags and links in the main layout:
  - `<link rel="manifest">`
  - `theme-color`
  - `apple-touch-icon`
  - Service worker registration script.
- Add grid style to body 

### Changed
- Main layout (`components/layouts/app.blade.php`) now includes PWA meta tags and service worker registration script.


--- 


## [1.3.0] - 2025-11-26

### Added
- RSS feed support using `spatie/laravel-feed`.
- `Route::feeds()` to enable `/feed` endpoint for consuming latest posts.
- `toFeedItem()` and `getFeedItems()` methods on the `Post` model to transform posts into RSS items.
- RSS auto-discovery meta tag in the main layout (`<link rel="alternate" type="application/rss+xml">`).
- Feed entries now use `seo_description` for their summary for better SEO + consistency.

### Changed
- Unified post URLs inside RSS feed to match canonical post URLs.
- Ensured feed returns only published posts, ordered by latest.

---

## [1.2.0] - 2025-11-26

### Added

- `post_meta` table and `PostMeta` model to store arbitrary key/value metadata for posts.
- `App\Traits\HasPostMeta` trait with:
  - `meta()` relationship
  - `getMeta()`, `setMeta()`, and `forgetMeta()` helpers
  - SEO accessors: `seo_title`, `seo_description`, `seo_canonical`, `seo_og_title`,
    `seo_og_description`, and `seo_og_image`.
- SEO Blade component at `resources/views/components/seo/post.blade.php` to render:
  - `<title>` tag
  - `description`, `keywords` (when present), and canonical meta tags
  - Open Graph and Twitter meta tags
  - `application/ld+json` BlogPosting JSON-LD with author and publisher data.
- SEO slot support in `app\View\Components\Layouts\App.php` and
  `resources/views/components/layouts/app.blade.php` to allow per-page SEO blocks.
- Automatic SEO fallback generation when no explicit post meta is defined
  (based on post title, excerpt/content, featured image, and route).

### Changed

- `app/Models/Post.php` now uses the `HasPostMeta` trait and delegates SEO/meta logic to it,
  keeping the model focused on core post behavior.
- `resources/views/livewire/pages/posts/show.blade.php` now passes the current post into
  the SEO component (via a layout slot) so each post page gets its own SEO block.
- `resources/views/components/seo/post.blade.php`:
  - Ensures descriptions are squished (no extra newlines/whitespace).
  - Uses absolute URLs for Open Graph / JSON-LD images.
  - Avoids rendering an empty `keywords` meta tag.

---

## [1.1.0] - 2025-11-26

### Added

- Initial public version of Artemis Journal.
- Basic blog functionality with posts, tags, comments, and user profiles.
- Post pricing fields (`price`, `old_price`) and discount percentage accessor.
- TailwindCSS, Alpine.js, Vite, and Livewire/Volt integration.
- Authentication, user dashboard, and post management pages.

---

> Note: Dates and details for earlier versions can be adjusted as needed if your actual history differs.
