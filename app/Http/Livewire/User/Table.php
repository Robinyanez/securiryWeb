<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Cargo;
use DB;
use Auth;

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

        $users = DB::table('users as u')
                    ->join('clients as c','c.id','=','u.client_id')
                    ->join('puestos as p','p.id','=','u.puesto_id')
                    ->join('cargos as g','g.id','=','u.cargo_id')
                    ->select('u.id as id','u.name as name','p.name as puesto','u.cedula as cedula','u.phone as phone','c.name as client','g.name as cargo')
                    ->where('u.name', 'LIKE', "%{$this->search}%")
                    ->where('u.name', '!=', Auth::user()->id)
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.user.table', compact('users'));
    }
}
