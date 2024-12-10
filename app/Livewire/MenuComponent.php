<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Food;
use App\Models\Category;

class MenuComponent extends Component
{   
    public $foods;
    public $categories;
    public function render()
    {   
        $this->foods = Food::all();
        $this->categories = Category::all();
        return view('livewire.menu-component')->layout('components.layouts.user');
    }
}
