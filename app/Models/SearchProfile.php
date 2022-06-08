<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function fields()
    {
        return $this->morphMany(Field::class, 'fieldable');
    }
}