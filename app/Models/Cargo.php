<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = "cargos";
    protected $primaryKey = "id";

    protected $fillable=[
        'name',
        'slug',
        'description',
    ];

    public function users() {
        return $this->hasMany(User::class, 'cargo_id', 'id');
    }
}
