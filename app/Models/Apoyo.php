<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoyo extends Model
{
    use HasFactory;

    protected $table = "apoyos";
    protected $primaryKey = "id";

    protected $fillable=[
        'actividad',
        'time_id',
        'puesto_id',
    ];

    public function image(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
