<?php

namespace App\Interfaces\Repositories;

interface PropertyRepositoryInterface
{
    public function findPropertyByIdWithFields($propertyId);
}
?>