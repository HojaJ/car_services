<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tm',
        'name_ru',
        'name_en',
        'image'
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
