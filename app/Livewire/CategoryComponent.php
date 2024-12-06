<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryComponent extends Component
{   

    public $categories;

    public function render()
    {   
        $this->categories = Category::all();
        return view('livewire.category-component')->layout('components.layouts.app');
    }
}
