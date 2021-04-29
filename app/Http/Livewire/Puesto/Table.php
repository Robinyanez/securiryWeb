<?php

namespace App\Http\Livewire\Puesto;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Puesto;
use DB;

class Table extends Component
{
    use WithPagination;

    protected $queryString = [
        'search'            => ['except' => ''],
        'perPage'           => ['except' => 5],
        'sortField'         => ['except' => 'id'],
        'sortDirection'     => ['except' => 'asc'],
    ];

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 5;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortByTable($field){

        $this->sortField = $field;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function clearTable(){

        $this->search = '';
        $this->page = 1;
        $this->perPage = 5;
    }

    public function render(){

        $puestos = Puesto::where('name', 'LIKE', "%{$this->search}%")
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate($this->perPage);
        return view('livewire.puesto.table', compact('puestos'));
    }
}
