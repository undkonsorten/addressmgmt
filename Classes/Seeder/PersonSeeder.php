<?php
/**
 * Created by IntelliJ IDEA.
 * User: eike
 * Date: 24.04.18
 * Time: 11:31
 */

namespace Undkonsorten\Addressmgmt\Seeder;


use TildBJ\Seeder\Faker;
use TildBJ\Seeder\Seed;
use Undkonsorten\Addressmgmt\Domain\Model\Address;


class PersonSeeder extends \TildBJ\Seeder\Seeder\DatabaseSeeder
{
    public function run(){
        $this->factory->create('tx_addressmgmt_domain_model_address',10)->each(function (Seed $seed, Faker $faker) {
            $seed->set(
                array (
                    'pid' => 60,
                    'sys_language_uid' => 0,
                    'hidden' => 0,
                    'title' => $faker->getTitle(),
                    'type' => Address::PERSON,
                    'name' => $faker->getLastName(),
                    'first_name' => $faker->getLastName(),
                    'gender' => 1,
                    'organisation' => $faker->getCompany(),
                    'department' => $faker->getCompanySuffix(),
                    'street' => $faker->getStreetName(),
                    'street_number' => $faker->getRandomDigitNotNull(),
                    'address_supplement' => $faker->getSentence(),
                    'city' => $faker->getCity(),
                    'zip' => $faker->getPostcode(),
                    'country' => $faker->getCountry(),
                    'state' => $faker->getState(),
                    'closest_city' => $faker->getCity(),
                    'email' => $faker->getEmail(),
                    'phone' => $faker->getPhoneNumber(),
                    'mobile' => $faker->getPhoneNumber(),
                    'fax' => $faker->getPhoneNumber(),
                    'www' => $this->call(PersonHompageSeeder::class),
                    'counterpart' => $faker->getSentence(),
                    'description' => $faker->getText(),
                    'directions' => $faker->getText(),
                    'latitude' => $faker->getLatitude(),
                    'longitude' => $faker->getLongitude(),
                    'images' => $this->call(\TildBJ\Seeder\Seeder\Image::class),
                    'category' => $this->call(PersonCategorySeeder::class),
                    'social_identifiers' => $this->call(PersonSocialMediaSeeder::class),

                )
            );
        });
    }

}
