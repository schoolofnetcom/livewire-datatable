<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
class Datatable extends Component
{
    use WithPagination;

    public $openAdvancedFilters = false;
    public $perPage = 10;
    public $sorts = [];
    public $filters = [
        "search" => null,
        "minStock" => null,
        "maxStock" => null,
        "status" => "",
    ];

    public function mount() {
        $this->perPage = session()->get('perPage', 10);
    }

    public function clearFilters() {
        $this->reset('filters');
    }

    // ['id' => 'asc', 'name' => 'desc']
    public function sortBy($column) {
        if(! isset($this->sorts[$column])) return $this->sorts[$column] = 'asc';
        if($this->sorts[$column] === 'asc') return $this->sorts[$column] = 'desc';
        unset($this->sorts[$column]);
    }

    public function applySorting($query) {
        foreach($this->sorts as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        return $query;
    }

    // hook lifecicle
    public function updatedFilters() {
        $this->resetPage();
    }

    // hook lifecicle
    public function updatedPerPage($value) {
        $this->resetPage();
        session()->put('perPage', $value);
    }

    public function runQueryBuilder() {
        $query = Product::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where("name", "like", "%$search%"))
            ->when($this->filters['minStock'], fn($query, $min) => $query->where("stock", ">=", $min))
            ->when($this->filters['maxStock'], fn($query, $max) => $query->where("stock", "<=", $max))
            ->when($this->filters['status'], fn($query, $status) => $query->where("status", "=", $status == 'ativo' ? 1 : 0));
        return $this->applySorting($query);
    }

    public function render()
    {
        return view('livewire.datatable', [
            "products" => $this->runQueryBuilder()->paginate($this->perPage),
        ]);
    }
}
