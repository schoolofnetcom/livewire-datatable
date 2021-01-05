<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
class Datatable extends Component
{
    use WithPagination;

    public $filters = [
        "search" => null,
    ];

    // hook lifecicle
    public function updatedFilters() {
        $this->resetPage();
    }

    public function runQueryBuilder() {
        $query = Product::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where("name", "like", "%$search%"));
        return $query;
    }

    public function render()
    {
        return view('livewire.datatable', [
            "products" => $this->runQueryBuilder()->paginate(10),
        ]);
    }
}
