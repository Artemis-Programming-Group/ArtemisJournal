const CACHE_NAME = 'artemisjournal-cache-v1';

// You can tune this list:
const OFFLINE_URL = '/offline';
const PRECACHE_URLS = [
    '/',
    OFFLINE_URL,
    '/manifest.webmanifest'
];

// Install: cache core assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_URLS);
        })
    );
    self.skipWaiting();
});

// Activate: cleanup old caches if you change version
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((key) => key !== CACHE_NAME)
                    .map((key) => caches.delete(key))
            )
        )
    );
    self.clients.claim();
});

// Fetch: basic network-first for HTML, cache-first for others
self.addEventListener('fetch', (event) => {
    const request = event.request;

    // Only handle GET
    if (request.method !== 'GET') {
        return;
    }

    if (request.headers.get('accept')?.includes('text/html')) {
        // HTML: try network, fallback to offline page
        event.respondWith(
            fetch(request)
                .then((response) => {
                    const copy = response.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(request, copy);
                    });
                    return response;
                })
                .catch(async () => {
                    const cache = await caches.open(CACHE_NAME);
                    const cached = await cache.match(request);
                    return (
                        cached ||
                        (await cache.match(OFFLINE_URL)) ||
                        new Response('Offline', { status: 503 })
                    );
                })
        );
    } else {
        // Assets: cache-first
        event.respondWith(
            caches.match(request).then((cached) => {
                if (cached) return cached;

                return fetch(request)
                    .then((response) => {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(request, copy);
                        });
                        return response;
                    })
                    .catch(() => cached || new Response('', { status: 503 }));
            })
        );
    }
});
