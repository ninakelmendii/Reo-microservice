<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchProfileRepositoryInterface;
use App\Models\SearchProfile;
use App\Repositories\BaseRepository;

class SearchProfileRepository extends BaseRepository implements SearchProfileRepositoryInterface
{
    protected $model;

    public function __construct(SearchProfile $searchProfile)
    {
        parent::__construct($searchProfile);
    }

    public function getSearchProfilesByPropertyTypeIdAndFieldName($property, $propertyFieldNames)
    {
        return $this->model->where('property_type_id', $property->propertyType->id)
                            ->with(['fields'])
                            ->whereHas('fields',function($query) use ($propertyFieldNames) {
                                $query->whereIn('name', $propertyFieldNames);
                            })
                            ->pluck('id');
    }
}