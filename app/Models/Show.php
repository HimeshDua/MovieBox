<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{

    use HasFactory;

    protected $fillable = [
        "platform",
        "location",
        "city",
        "show_time",
        "show_date",
        "movie_id"
    ];

    public function movies()
    {
        return  $this->belongsTo(Movie::class);
    }
}
