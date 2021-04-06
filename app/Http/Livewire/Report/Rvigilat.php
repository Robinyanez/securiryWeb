<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class Rvigilat extends Component
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
                -> join('times as t','u.id','=','t.users_id')
                ->select('u.id as id','u.name as name', 't.lat as lat', 't.lng as lng', 't.date_time as date')
                ->where('role', 'Vigilante')
                ->where('name', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);

        /* $users = User::with('times')
                    ->where('role', 'Vigilante')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->perPage); */
        return view('livewire.report.rvigilat', compact('users'));
    }
}
