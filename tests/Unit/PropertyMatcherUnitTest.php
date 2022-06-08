<?php

namespace Tests\Unit;

use App\Domains\PropertyMatcher;
use App\Models\Field;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class PropertyMatcherUnitTest extends TestCase
{
    use CreatesApplication;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_checkIfPropertyFieldMatchesSearchField_matchesPropertyToSearchField()
    {
        $profileField1 = new Field();
        $profileField1->name = 'price';
        $profileField1->value = [10000,20000];
        $profileField1->fieldable_id = 1;

        $profileField2 = new Field();
        $profileField2->name = 'rooms';
        $profileField2->value = 5;
        $profileField2->fieldable_id = 1;

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 5;
        $propertyField1->fieldable_id = 1;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 20001;
        $propertyField2->fieldable_id = 2;

        $searchProfileFields = [$profileField1, $profileField2];
        $propertyFields = [$propertyField1, $propertyField2];

        $propertyMatcher = app()->make(PropertyMatcher::class);
        $result = $propertyMatcher->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);

        $this->assertNotEmpty($result);
        $this->assertTrue($result[1]['score'] == 3);
    }

    public function test_should_not_checkIfPropertyFieldMatchesSearchField_matchAnyFieldsIfIncorrectNamesAreGiven()
    {
        $profileField1 = new Field();
        $profileField1->name = 'prite';
        $profileField1->value = [10000,20000];
        $profileField1->fieldable_id = 1;

        $profileField2 = new Field();
        $profileField2->name = 'rome';
        $profileField2->value = 5;
        $profileField2->fieldable_id = 1;

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 5;
        $propertyField1->fieldable_id = 1;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 20001;
        $propertyField2->fieldable_id = 2;

        $searchProfileFields = [$profileField1, $profileField2];
        $propertyFields = [$propertyField1, $propertyField2];

        $propertyMatcher = app()->make(PropertyMatcher::class);
        $result = $propertyMatcher->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);

        $this->assertEmpty($result);
    }

    public function test_should_checkIfPropertyFieldMatchesSearchField_checkLooseMatchesCount()
    {
        $profileField1 = new Field();
        $profileField1->name = 'price';
        $profileField1->value = [10000,20000];
        $profileField1->fieldable_id = 1;

        $profileField2 = new Field();
        $profileField2->name = 'yearOfConstruction';
        $profileField2->value = [2021,2025];
        $profileField2->fieldable_id = 1;

        $propertyField1 = new Field();
        $propertyField1->name = 'yearOfConstruction';
        $propertyField1->value = 2020;
        $propertyField1->fieldable_id = 1;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 20001;
        $propertyField2->fieldable_id = 2;

        $searchProfileFields = [$profileField1, $profileField2];
        $propertyFields = [$propertyField1, $propertyField2];

        $propertyMatcher = app()->make(PropertyMatcher::class);
        $result = $propertyMatcher->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);

        $this->assertNotEmpty($result);
        $this->assertTrue($result[1]['looseMatchesCount'] == 2);
    }

    public function test_should_checkIfPropertyFieldMatchesSearchField_checkStrictMatchesCount()
    {
        $profileField1 = new Field();
        $profileField1->name = 'price';
        $profileField1->value = [10000,20000];
        $profileField1->fieldable_id = 1;

        $profileField2 = new Field();
        $profileField2->name = 'yearOfConstruction';
        $profileField2->value = [2021,2025];
        $profileField2->fieldable_id = 1;

        $propertyField1 = new Field();
        $propertyField1->name = 'yearOfConstruction';
        $propertyField1->value = 2023;
        $propertyField1->fieldable_id = 1;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 10100;
        $propertyField2->fieldable_id = 2;

        $searchProfileFields = [$profileField1, $profileField2];
        $propertyFields = [$propertyField1, $propertyField2];

        $propertyMatcher = app()->make(PropertyMatcher::class);
        $result = $propertyMatcher->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);

        $this->assertNotEmpty($result);
        $this->assertTrue($result[1]['strictMatchesCount'] == 2);
    }

    public function test_should_checkIfPropertyFieldMatchesSearchField_checkIfMatchesScoreIsZero()
    {
        $profileField1 = new Field();
        $profileField1->name = 'price';
        $profileField1->value = [10000,20000];
        $profileField1->fieldable_id = 1;

        $profileField2 = new Field();
        $profileField2->name = 'rooms';
        $profileField2->value = 3;
        $profileField2->fieldable_id = 1;

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 1;
        $propertyField1->fieldable_id = 1;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 70000;
        $propertyField2->fieldable_id = 2;

        $searchProfileFields = [$profileField1, $profileField2];
        $propertyFields = [$propertyField1, $propertyField2];

        $propertyMatcher = app()->make(PropertyMatcher::class);
        $result = $propertyMatcher->checkIfPropertyFieldMatchesSearchField($searchProfileFields, $propertyFields);

        $this->assertNotEmpty($result);
        $this->assertTrue($result[1]['score'] == 0);
    }
}
