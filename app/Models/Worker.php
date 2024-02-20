<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'category_id',
        'profession_tm',
        'profession_en',
        'profession_ru',
        'working_hours_start',
        'working_hours_end'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
