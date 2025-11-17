<?php

use App\Models\Tag;
use App\Models\Post;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;


    public string $title;
    public string $excerpt;
    public string $content;
    public $featured_image;
    public string $price;
    public string $old_price;
    public array $tags = [];
    public string $reading_time;
    public string $status;


    #[\Livewire\Attributes\Computed]
    public function existingTags()
    {
        return Tag::all();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'reading_time' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'price' => 'nullable|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'tags' => 'nullable|array',
        ];
    }

    public function store()
    {

        $validated = $this->validate();

        if ($this->featured_image) {
            $validated['featured_image'] = $this->featured_image->store('posts', 'public');
        }

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);


        if ($this->tags != []) {
            $post->tags()->attach($this->tags);
        }

        $this->redirectRoute('dashboard');
    }
};
?>

<div class="max-w-4xl mx-auto py-8">
    <x-ui.breadcrumb :items="[
        ['label' => __('Posts'), 'url' => route('posts.index')],
        __('Create New Post')
    ]" />

    <x-partial.post-form :tags="$this->tags" :wire="true" wireAction="store" />

</div>
