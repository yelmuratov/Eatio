<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Food;
use App\Models\Category;

class FoodComponent extends Component
{
    use WithFileUploads;

    public $foods;
    public $categories;
    public $name;
    public $category_id;
    public $description;
    public $price;
    public $image;
    public $food_id;
    public $searchTerm='';

    public function render()
    {
        $this->foods = Food::where('name', 'like', '%' . $this->searchTerm . '%')->get();
        $this->categories = Category::all();

        return view('livewire.food-component')->layout('components.layouts.app');
    }

    public function deleteFood($id)
    {
        $food = Food::find($id);
        if ($food) {
            $food->delete();
            session()->flash('message', 'Food has been deleted successfully!');
        }
    }

    public function addFood()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image', // 1MB Max
        ]);

        $imageName = $this->image->store('photos', 'public');

        Food::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'image' => basename($imageName),
        ]);

        session()->flash('message', 'Food has been added successfully!');
        $this->resetInputFields();
    }

    public function editFood($id)
    {
        $food = Food::find($id);
        $this->food_id = $food->id;
        $this->name = $food->name;
        $this->category_id = $food->category_id;
        $this->description = $food->description;
        $this->price = $food->price;
        $this->image = null; // Reset image input
    }

    public function updateFood()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image', // 1MB Max
        ]);

        $food = Food::find($this->food_id);

        if ($this->image) {
            $imageName = $this->image->store('photos', 'public');
            $food->image = basename($imageName);
        }

        $food->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Food has been updated successfully!');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->description = '';
        $this->price = '';
        $this->image = null;
    }

    public function search($text){
        dd($this->searchTerm);
    }
}
