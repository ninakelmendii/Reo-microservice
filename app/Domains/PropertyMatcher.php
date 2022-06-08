<?php

namespace App\Domains;

use App\Enums\PercentageValue;
use App\Interfaces\Domains\PropertyMatcherInterface;

class PropertyMatcher implements PropertyMatcherInterface
{
    public function checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields)
    {
        $matchedPropertySearchProfiles = [];
        foreach($searchProfileFields as $searchProfileField){
            $looseMatches = 0;
            $strictMatches = 0;
            foreach($propertyFields as $propertyField){
                if($propertyField['name'] == $searchProfileField['name']){
                    $propertyFieldValue = $propertyField->value;
                    $searchProfileId = $searchProfileField['fieldable_id'];
    
                    if(is_array($searchProfileField['value'])){
                        $searchProfileMinPrice = $searchProfileField['value'][0];
                        $searchProfileMaxPrice = $searchProfileField['value'][1];
    
                        if(($searchProfileMinPrice <= $propertyFieldValue) && ($propertyFieldValue <= $searchProfileMaxPrice)){
                            $strictMatches++;
                        }else{
                            $looseSearchProfilePrice = $this->calculateDeviationPercentage($searchProfileMinPrice, $searchProfileMaxPrice);
    
                            $looseSearchProfileMinPrice = $looseSearchProfilePrice['newLooseSearchProfileMinPrice'];
                            $looseSearchProfileMaxPrice = $looseSearchProfilePrice['newLooseSearchProfileMaxPrice'];
            
                            if(($looseSearchProfileMinPrice <= $propertyFieldValue) && ($propertyFieldValue <= $looseSearchProfileMaxPrice)){
                                $looseMatches++;
                            }
                        }
                    }else{
                        if($propertyFieldValue == $searchProfileField['value']){
                            $strictMatches++;
                        }
                    }
                }
            }
            if(isset($searchProfileId)){
                $matchedPropertySearchProfiles[] = [
                    'searchProfileId' => $searchProfileId, 'strictMatchesCount' => $strictMatches, 'looseMatchesCount' => $looseMatches
                ];
            }
        }
        return $this->totalPropertyMatchedSearchProfiles($matchedPropertySearchProfiles);
    }

    private function calculateDeviationPercentage($searchProfileMinPrice, $searchProfileMaxPrice)
    {
        $percentageDeviation = PercentageValue::DEVIATION;

        $newLooseSearchProfileMinPrice = $searchProfileMinPrice - ($searchProfileMinPrice * ($percentageDeviation / 100));
        $newLooseSearchProfileMaxPrice = $searchProfileMaxPrice + ($searchProfileMinPrice * ($percentageDeviation / 100));

        return [
            'newLooseSearchProfileMinPrice' => $newLooseSearchProfileMinPrice,
            'newLooseSearchProfileMaxPrice' => $newLooseSearchProfileMaxPrice
        ];
    }

    private function totalPropertyMatchedSearchProfiles($matchedPropertySearchProfiles)
    {
        $searchProfileId = null;
        $strictMatchesCount = 0;
        $looseMatchesCount = 0;

        $totalMatchedSearchProfiles = [];

        foreach($matchedPropertySearchProfiles as $matchedPropertySearchProfile){
            if ($searchProfileId != $matchedPropertySearchProfile['searchProfileId']) {
                $searchProfileId = $matchedPropertySearchProfile['searchProfileId'];
                $strictMatchesCount = 0;
                $looseMatchesCount = 0;
            }

            if ($searchProfileId == $matchedPropertySearchProfile['searchProfileId']) {                
                $strictMatchesCount += $matchedPropertySearchProfile['strictMatchesCount'];
                $looseMatchesCount += $matchedPropertySearchProfile['looseMatchesCount'];

                $score = ($strictMatchesCount * 2) + $looseMatchesCount;

                $totalMatchedSearchProfiles[$searchProfileId]['searchProfileId'] = $searchProfileId;
                $totalMatchedSearchProfiles[$searchProfileId]['score'] = $score;
                $totalMatchedSearchProfiles[$searchProfileId]['strictMatchesCount'] = $strictMatchesCount;
                $totalMatchedSearchProfiles[$searchProfileId]['looseMatchesCount'] = $looseMatchesCount;
            }
        }
        return $totalMatchedSearchProfiles;
    }
}
