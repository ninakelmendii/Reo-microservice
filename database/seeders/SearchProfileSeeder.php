<?php

namespace Database\Seeders;

use App\Enums\PropertyType;
use App\Models\Field;
use App\Models\SearchProfile;
use Illuminate\Database\Seeder;

class SearchProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstSearchProfile = SearchProfile::create([
            'name' => 'Looking for a small apartment downtown',
            'property_type_id' => PropertyType::RENT
        ]);

        $firstSearchField = new Field();
        $firstSearchField->name = 'price';
        $firstSearchField->value = [7000,8000];
        $firstSearchProfile->fields()->save($firstSearchField);

        $nina = new Field();
        $nina->name = 'rooms';
        $nina->value = "4";
        $firstSearchProfile->fields()->save($nina);

        $secondSearchProfile = SearchProfile::create([
            'name' => 'Looking for a family apartment downtown',
            'property_type_id' => PropertyType::RENT
        ]);

        $secondSearchField = new Field();
        $secondSearchField->name = 'numberOfRooms';
        $secondSearchField->value = '4';
        $secondSearchProfile->fields()->save($secondSearchField);

        $thirdSearchProfile = SearchProfile::create([
            'name' => 'Looking for an apartment',
            'property_type_id' => PropertyType::RENT
        ]);

        $thirdSearchField = new Field();
        $thirdSearchField->name = 'hasParking';
        $thirdSearchField->value = false;
        $thirdSearchProfile->fields()->save($thirdSearchField);

        $fourthSearchProfile = SearchProfile::create([
            'name' => 'Looking for a house in the suburbs',
            'property_type_id' => PropertyType::SALE
        ]);

        $fourthSearchField = new Field();
        $fourthSearchField->name = 'numberOfRooms';
        $fourthSearchField->value = '6';
        $fourthSearchProfile->fields()->save($fourthSearchField);

        $fifthSearchProfile = SearchProfile::create([
            'name' => 'Looking for a big house',
            'property_type_id' => PropertyType::SALE
        ]);

        $fifthSearchField = new Field();
        $fifthSearchField->name = 'price';
        $fifthSearchField->value = '9000,12000';
        $fifthSearchProfile->fields()->save($fifthSearchField);

        $sixthSearchProfile = SearchProfile::create([
            'name' => 'Looking for a big family house',
            'property_type_id' => PropertyType::SALE
        ]);

        $sixthSearchField = new Field();
        $sixthSearchField->name = 'yearOfContruction';
        $sixthSearchField->value = [2019,null];
        $sixthSearchProfile->fields()->save($sixthSearchField);
    }
}
