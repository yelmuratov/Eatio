<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class CategoryComponent extends Component
{   
    use WithPagination;

    public $name;
    public $description;
    public $category_id;

    public function render()
    {   
        $categories = Category::paginate(5);
        return view('livewire.category-component', ['categories' => $categories])->layout('components.layouts.app');
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category has been deleted successfully!');
        }
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('message', 'Category has been added successfully!');
        $this->resetInputFields();
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->category_id,
            'description' => 'required',
        ]);

        $category = Category::find($this->category_id);
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('message', 'Category has been updated successfully!');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
    }
}
