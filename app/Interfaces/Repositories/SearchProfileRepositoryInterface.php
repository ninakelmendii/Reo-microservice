<?php

namespace App\Interfaces\Repositories;

interface SearchProfileRepositoryInterface
{
    public function getSearchProfilesByPropertyTypeIdAndFieldName($propertyTypeId, $propertyFieldNames);
}
?>