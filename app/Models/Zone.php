<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = "zones";
    protected $primaryKey = "id";

    protected $fillable=[
        'name',
        'slug',
        'phone',
        'email',
    ];

    public function clients() {
        return $this->hasMany(Client::class, 'zone_id', 'id');
    }
}
