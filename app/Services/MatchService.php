<?php

namespace App\Services;

use App\Interfaces\Domains\PropertyMatcherInterface;
use App\Interfaces\Repositories\FieldRepositoryInterface;
use App\Interfaces\Repositories\PropertyRepositoryInterface;
use App\Interfaces\Repositories\SearchProfileRepositoryInterface;
use App\Interfaces\Services\MatchServiceInterface;

class MatchService implements MatchServiceInterface
{
    protected $searchProfileRepository;
    protected $propertyRepository;
    protected $fieldRepository;
    protected $propertyMatcherDomain;

    public function __construct(
        SearchProfileRepositoryInterface $searchProfileRepository,
        PropertyRepositoryInterface $propertyRepository,
        FieldRepositoryInterface $fieldRepository,
        PropertyMatcherInterface $propertyMatcherDomain
    )
    {
        $this->searchProfileRepository = $searchProfileRepository;
        $this->propertyRepository = $propertyRepository;
        $this->fieldRepository = $fieldRepository;
        $this->propertyMatcherDomain = $propertyMatcherDomain;
    }

    public function getPropertyMatches($propertyId)
    {
        $property = $this->propertyRepository->findPropertyByIdWithFields($propertyId);
        
        return $this->propertyAndSearchProfileFieldCheck($property);
    }

    private function propertyAndSearchProfileFieldCheck($property)
    {
        $propertyFields = $property->fields;

        $propertyFieldNames = [];
        foreach($propertyFields as $propertyField){
            $propertyFieldNames[] = $propertyField->name;
        }
       
        $searchProfileIds = $this->searchProfileRepository->getSearchProfilesByPropertyTypeIdAndFieldName($property, $propertyFieldNames);
        $searchProfileFields = $this->fieldRepository->getSearchProfileFieldsByIdAndType($searchProfileIds);
        
        return $this->propertyMatcherDomain->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);       
    }
}
