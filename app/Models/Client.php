<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "clients";
    protected $primaryKey = "id";

    protected $fillable=[
        'name',
        'cedula',
        'phone',
        'email',
        'users_id',
        'countries_id',
        'zones_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
