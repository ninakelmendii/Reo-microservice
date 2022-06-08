<?php

namespace App\Interfaces\Domains;

interface PropertyMatcherInterface
{
    public function checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);
}
