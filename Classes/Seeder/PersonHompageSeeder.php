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


class PersonHompageSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->factory->create('tx_addressmgmt_domain_model_link')->each(function (Seed $seed, Faker $faker) {
            $seed->set(
                array (
                    'pid' => 60,
                    'sys_language_uid' => 0,
                    'hidden' => 0,
                    'text' => $faker->getDomainWord(),
                    'link' => $faker->getDomainWord()
                )
            );
        });
    }
}
