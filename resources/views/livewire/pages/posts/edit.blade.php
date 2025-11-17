<?php

use App\Models\Tag;
use App\Models\Post;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;
    public Post $post;

    public ?string $title;
    public ?string $excerpt;
    public ?string $content;
    public $featured_image;
    public ?string $price;
    public ?string $old_price;
    public ?array $tags = [];
    public ?string $reading_time;
    public ?string $status;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $this->post->title;
        $this->excerpt = $this->post->excerpt;
        $this->content = $this->post->content;
        $this->price = $this->post->price;
        $this->old_price = $this->post->old_price;
        $this->tags = $this->post->tags->pluck('id')->toArray();
        $this->reading_time = $this->post->reading_time;
        $this->status = $this->post->status;

        $this->authorize('update', $post);
    }

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
    public function update()
    {

        $validated = $this->validate();


        if ($this->featured_image) {
            if ($this->post->featured_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->post->featured_image);
            }
            $validated['featured_image'] = $this->featured_image->store('posts', 'public');
        } else {
            unset($validated['featured_image']);
        }


        $this->post->update($validated);


        if ($this->tags != []) {
            $this->post->tags()->sync($this->tags ?? []);
        }

        $this->redirectRoute('dashboard');
    }
};
?>

<div class="max-w-4xl mx-auto py-8">
    <x-ui.breadcrumb :items="[
        ['label' => __('Posts'), 'url' => route('posts.index')],
        ['label' => $post->title, 'url' => route('posts.show', $post)],
        'Edit'
    ]" />

    <x-partial.post-form :post="$post" :tags="$this->tags" :wire="true" wireAction="update" />
</div>
