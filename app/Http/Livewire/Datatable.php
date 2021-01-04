<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Datatable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.datatable', [
            'products' => Product::paginate(10)
        ]);
    }
}
