<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address'
    ];

    public function fields()
    {
        return $this->morphMany(Field::class, 'fieldable');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
