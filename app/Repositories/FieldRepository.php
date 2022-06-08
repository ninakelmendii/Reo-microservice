<?php

namespace App\Repositories;

use App\Enums\FieldableType;
use App\Interfaces\Repositories\FieldRepositoryInterface;
use App\Models\Field;
use App\Repositories\BaseRepository;

class FieldRepository extends BaseRepository implements FieldRepositoryInterface
{
    protected $model;

    public function __construct(Field $field)
    {
        parent::__construct($field);
    }

    public function getSearchProfileFieldsByIdAndType($searchProfileId)
    {
        return $this->model->whereIn('fieldable_id', $searchProfileId)
                            ->where('fieldable_type', FieldableType::SEARCH_PROFILE)
                            ->get();
    }
}