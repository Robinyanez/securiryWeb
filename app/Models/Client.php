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
        'slug',
        'cedula',
        'phone',
        'email',
        'lat',
        'lng',
        'country_id',
        'zone_id'
    ];

    public function users() {
        return $this->hasMany(User::class, 'client_id', 'id');
    }

    public function ciudad() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function zone() {
        return $this->belongsTo(zone::class, 'zone_id', 'id');
    }
}
