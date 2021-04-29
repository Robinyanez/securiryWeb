<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = "countries";
    protected $primaryKey = "id";

    protected $fillable=[
        'name',
        'slug',
        'description',
    ];

    public function clients() {
        return $this->hasMany(Client::class, 'country_id', 'id');
    }
}
