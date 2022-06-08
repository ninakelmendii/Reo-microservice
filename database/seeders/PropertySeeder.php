<?php

namespace Database\Seeders;

use App\Enums\PropertyType;
use App\Models\Field;
use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartmentProperty = Property::create([
            'name' => 'Apartment downtown',
            'address' => '9699 Madison Street, NY',
            'property_type_id' => PropertyType::RENT
        ]);

        
        $houseProperty = Property::create([
            'name' => 'House for family in suburb',
            'address' => '9691 Union Square, NY',
            'property_type_id' => PropertyType::SALE 
        ]);

        $apartmentPropertyField = new Field();
        $apartmentPropertyField->name = 'price';
        $apartmentPropertyField->value = '6000';
        $apartmentProperty->fields()->save($apartmentPropertyField);

        $apartmentPropertyField = new Field();
        $apartmentPropertyField->name = 'rooms';
        $apartmentPropertyField->value = '4';
        $apartmentProperty->fields()->save($apartmentPropertyField);

        $apartmentPropertyField = new Field();
        $apartmentPropertyField->name = 'hasParking';
        $apartmentPropertyField->value = false;
        $apartmentProperty->fields()->save($apartmentPropertyField);

        $housePropertyField = new Field();
        $housePropertyField->name = 'price';
        $housePropertyField->value = '8000';
        $houseProperty->fields()->save($housePropertyField);

        $housePropertyField = new Field();
        $housePropertyField->name = 'hasParking';
        $housePropertyField->value = true;
        $houseProperty->fields()->save($housePropertyField);

        $housePropertyField = new Field();
        $housePropertyField->name = 'yearOfContruction';
        $housePropertyField->value = '2020';
        $houseProperty->fields()->save($housePropertyField);
    }
}
