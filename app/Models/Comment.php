<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $primaryKey = "id";

    protected $fillable=[
        'type',
        'description',
        'times_id',
    ];

    public function image(){
        return $this->morphMany(User::class, 'imageable');
    }
}
