<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;
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

        $clients = DB::table('clients as cli')
                    ->join('countries as co','co.id','=','cli.country_id')
                    /* ->join('zones as zo','zo.id','=','cli.zone_id') */
                    ->select('cli.id as id','cli.name as name','cli.cedula as cedula','cli.phone as phone','cli.email as email','co.name as city'/* ,'zo.name as zona' */)
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->perPage);

        /* dd($clients); */

        return view('livewire.client.table', compact('clients'));
    }
}
