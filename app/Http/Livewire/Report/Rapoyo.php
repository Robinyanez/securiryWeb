<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use DB;

class Rapoyo extends Component
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
                ->join('times as t','u.id','=','t.user_id')
                ->join('apoyos as a','t.id','=','a.time_id')
                ->select('t.id as id','u.name as name','a.actividad as type','c.lat as latcli','c.lng as lngcli','t.lat as lat','t.lng as lng','t.date_time as date')
                ->where('u.cargo_id','4')
                ->where('t.type','Apoyo')
                ->where('u.name', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);

                /* dd($users); */

        return view('livewire.report.rapoyo', compact('users'));
    }
}
