<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use DB;

class Rdenuncia extends Component
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
                ->join('clients as cl','cl.id','=','u.client_id')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                ->select('t.id as id','u.name as name','cl.lat as latcli','cl.lng as lngcli','t.type as type','c.id as id_comment','t.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Denuncia')
                ->where('u.name', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);

        $images = DB::table('images')->select('url','imageable_id')->where('imageable_type','App\Models\Comment')->get();

        return view('livewire.report.rdenuncia', compact('users','images'));
    }
}
