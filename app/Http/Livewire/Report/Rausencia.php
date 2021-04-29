<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use DB;

class Rausencia extends Component
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
                -> join('times as t','u.id','=','t.user_id')
                -> join('comments as c','c.time_id','=','t.id')
                ->select('u.id as id','u.name as name', 't.id as id_time','t.type as type', 't.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description', 'c.url_img as url_img')
                ->where('t.type', 'Aucencia Relevo')
                ->where('u.name', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);

        /* dd($users); */

        return view('livewire.report.rausencia', compact('users'));
    }
}
