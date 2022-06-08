<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = [
            'Rent',
            'Sale'
        ];

        foreach($propertyTypes as $propertyType){
            PropertyType::create([
                'name' => $propertyType,
            ]);
        }
    }
}
