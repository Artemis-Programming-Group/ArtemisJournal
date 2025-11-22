<!-- Swiper.js -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!-- Highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/wvj96glw8ghg85zll4jok7bknhwi4lropfzu5qvuw42jgrlg/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    // Create a global namespace to prevent redeclaration
    window.TinyMCELivewire = window.TinyMCELivewire || {
        initialized: false,

        triggerLivewireUpdate: function(textarea) {
            textarea.dispatchEvent(new Event('input', {
                bubbles: true
            }));
            textarea.dispatchEvent(new Event('change', {
                bubbles: true
            }));
        },

        initialize: function() {
            console.log('TinyMCE Initialize called');

            // Check if there are any textareas to initialize
            const textareas = document.querySelectorAll('textarea.tiny-editor');
            console.log('Found textareas:', textareas.length);

            if (textareas.length === 0) {
                console.log('No textareas found, skipping initialization');
                return;
            }

            // Remove existing instances first
            if (typeof tinymce !== 'undefined') {
                tinymce.remove('textarea.tiny-editor');
            }

            const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

            tinymce.init({
                resize: true,
                min_height: 500,
                selector: 'textarea.tiny-editor',
                language: 'fa',
                plugins: [
                    'accordion', 'advlist', 'anchor', 'autolink', 'autoresize', 'charmap', 'code',
                    'codesample', 'directionality', 'emoticons', 'fullscreen', 'help', 'image',
                    'importcss', 'insertdatetime', 'link', 'lists', 'media',
                    'nonbreaking', 'pagebreak', 'preview', 'quickbars', 'searchreplace',
                    'table', 'visualblocks', 'visualchars', 'wordcount',
                ],
                menubar: 'file edit view insert format tools table help',
                toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | print | pagebreak anchor codesample | ltr rtl",
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image table',
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',
                content_style: 'body { font-family:"IRANSans-FaNum", "IRANYekan", Helvetica,Arial,sans-serif; font-size:16px; direction: rtl; }',
                directionality: 'rtl',

                setup: function(editor) {
                    const self = window.TinyMCELivewire;

                    editor.on('init', function() {
                        console.log('TinyMCE editor initialized:', editor.id);
                    });

                    editor.on('change', function() {
                        editor.save();
                        self.triggerLivewireUpdate(editor.getElement());
                    });

                    editor.on('blur', function() {
                        editor.save();
                        self.triggerLivewireUpdate(editor.getElement());
                    });

                    editor.on('keyup', function() {
                        editor.save();
                        self.triggerLivewireUpdate(editor.getElement());
                    });

                    editor.on('submit', function() {
                        editor.save();
                    });
                }
            });

            this.initialized = true;
            console.log('TinyMCE initialized successfully');
        },

        destroy: function() {
            console.log('TinyMCE Destroy called');
            if (typeof tinymce !== 'undefined') {
                tinymce.remove();
            }
            this.initialized = false;
        }
    };

    // Initialize on page load
    function initOnLoad() {
        console.log('Document ready, initializing TinyMCE');
        // Use a small delay to ensure DOM is fully ready
        setTimeout(function() {
            window.TinyMCELivewire.initialize();
        }, 100);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initOnLoad);
    } else {
        initOnLoad();
    }

    // Reinitialize after Livewire navigation
    document.addEventListener('livewire:navigated', function() {
        console.log('Livewire navigated, reinitializing TinyMCE');
        setTimeout(function() {
            window.TinyMCELivewire.initialize();
        }, 100);
    });

    // Clean up before Livewire navigation
    document.addEventListener('livewire:navigating', function() {
        console.log('Livewire navigating, destroying TinyMCE');
        window.TinyMCELivewire.destroy();
    });
</script>
<!-- Initialize Highlight.js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        hljs.highlightAll();
    });
</script>

<!-- Initialize Swiper -->
<script>
    // const swiper = new Swiper('.relatedSwiper', {
    //     spaceBetween: 20,
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     slidesPerView: 1,
    //     },
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 2,
    //         },
    //         1024: {
    //             slidesPerView: 3,
    //         },
    //     },
    // });
</script>
