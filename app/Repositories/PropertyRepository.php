<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PropertyRepositoryInterface;
use App\Models\Property;
use App\Repositories\BaseRepository;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    protected $model;

    public function __construct(Property $property)
    {
        parent::__construct($property);
    }

    public function findPropertyByIdWithFields($propertyId)
    {
        return $this->model->where('id', $propertyId)->with('fields')->first();
    }
}