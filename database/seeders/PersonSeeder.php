<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run()
    {
        // Exemples de données - remplacez par vos vraies photos
        $persons = [
            [
                'name' => 'Bob',
                'face_photo' => 'faces/bob_face.png',
                'feet_photo' => 'feet/bob_feet.jpeg',
            ],
            [
                'name' => 'Georges',
                'face_photo' => 'faces/georges_face.jpg',
                'feet_photo' => 'feet/georges_feet.jpg',
            ],
            [
                'name' => 'Charlie',
                'face_photo' => 'faces/brr_brr_patapim_face.jpg',
                'feet_photo' => 'feet/brr_brr_patapim_feet.jpg',
            ]
        ];

        foreach ($persons as $personData) {
            Person::create($personData);
        }
    }
}