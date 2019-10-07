<?php

namespace App\Tests\Unit;

use Faker\{
    Factory,
    Generator
};
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;

class KernelTestCase extends BaseKernelTestCase
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
