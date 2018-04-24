<?php
/**
 * Created by IntelliJ IDEA.
 * User: eike
 * Date: 24.04.18
 * Time: 12:16
 */

namespace Undkonsorten\Addressmgmt\Seeder;

use TildBJ\Seeder\Faker;
use TildBJ\Seeder\Seed;
use TildBJ\Seeder\Seeder\DatabaseSeeder;


class SocialMediaProviderSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->factory->create('tx_addressmgmt_domain_model_socialprovider')->each(function (Seed $seed, Faker $faker) {
            $seed->set(
                array (
                    'pid' => 1,
                    'sys_language_uid' => 0,
                    'hidden' => 0,
                    'name' => $faker->getDomainWord(),
                    'link' => $faker->getDomainWord(),
                    'identifier_description' => $faker->getSentence(),
                )
            );
        });
    }
}
