<?php

use App\Models\Tag;
use Livewire\Volt\Component;

new class extends Component {

    public $name;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name',
        ];
    }
    public function store()
    {
        $this->validate();

        Tag::create(['name' => $this->name]);

        session()->flash('success', __('Tag created successfully'));
    }
};
?>

<div class="max-w-2xl mx-auto py-8">
    <x-ui.breadcrumb :wireNavigate="true" :items="[
        ['label' => __('Dashboard'), 'url' => route('dashboard')],
        ['label' => __('Tags'), 'url' => route('tags.index')],
        __('Create New Tag')
    ]" />


    <x-partial.tag-form :wire="true" wireAction="store" />
</div>
