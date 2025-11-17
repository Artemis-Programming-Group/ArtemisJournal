<?php

use Livewire\Volt\Component;
use App\Models\Tag;

new class extends Component {
    public Tag $tag;

    public $name;

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
        $this->name = $tag->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->tag->update(['name' => $this->name]);

        session()->flash('success', __('Tag updated successfully'));
    }
};
?>

<div class="max-w-2xl mx-auto py-8">
    <x-ui.breadcrumb :items="[
        ['label' => __('Tags'), 'url' => route('tags.index')],
        __('Create New Tag'),
    ]" />

    <x-partial.tag-form :tag="$tag" wire="true" wireAction="update" />
</div>
