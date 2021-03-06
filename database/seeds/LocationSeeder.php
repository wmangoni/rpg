<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adjacent_location')->delete();
        DB::table('locations')->delete();

        $locations = [
            [
                "id"            => 1,
                "name"          => "Inn",
                "description"   => "An establishment or building providing lodging and, usually, food and drink for travelers (Starting location)",
                "image"         => "locations/Inn-800px.png",
                "image_sm"      => "locations/Inn-300px.png",
            ],
            [
                "id"            => 2,
                "name"          => "Town Hall",
                "description"   => "Public forum or meeting in which those attending gather to discuss civic or political issues, hear and ask questions about the ideas of a candidate for public office",
                "image"         => "locations/Townhall-800px.png",
                "image_sm"      => "locations/Townhall-300px.png",
            ],
            [
                "id"            => 3,
                "name"          => "Smithy",
                "description"   => "A blacksmith's shop. A place to purchase weaponry and armor or train one's skill as a blacksmith",
                "image"         => "locations/Blacksmith-800px.png",
                "image_sm"      => "locations/Blacksmith-300px.png",
            ],
            [
                "id"            => 4,
                "name"          => "Military academy fortress",
                "description"   => "An institute where soldiers and mercenaries train they martial skills",
                "image"         => "locations/Fortress-800px.png",
                "image_sm"      => "locations/Fortress-300px.png",
            ],
        ];

        foreach ($locations as $location)
        {
            Location::create($location);
        }

        $adjacent_locations = [
            [
                "location_id"           => 1,
                "adjacent_location_id"  => 2,
                "direction"             => "north",
            ],
            [
                "location_id"           => 1,
                "adjacent_location_id"  => 3,
                "direction"             => "east",
            ],
            [
                "location_id"           => 1,
                "adjacent_location_id"  => 4,
                "direction"             => "south",
            ],
        ];

        foreach ($adjacent_locations as $record) {
            /** @var  $location Location */
            $location = Location::find($record['location_id']);

            /** @var  $adjacent_location Location */
            $adjacent_location = Location::find($record['adjacent_location_id']);

            $location->addAdjacentLocation($adjacent_location, $record['direction']);
        }
    }
}
