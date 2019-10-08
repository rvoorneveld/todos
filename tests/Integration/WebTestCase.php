<?php

namespace App\Tests\Integration;

use Faker\{
    Factory,
    Generator
};

class WebTestCase extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    protected $faker;

    protected function faker(): Generator
    {
        return $this->faker;
    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Factory::create();
    }

}
