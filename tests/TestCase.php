<?php

namespace Tests;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory;
use Faker\Generator;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication , WithFaker,DatabaseMigrations ,DatabaseTransactions;
    // private Generator $faker;
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->artisan('migrate');
        $this->artisan('db:seed');
        $this->withoutExceptionHandling();
    }


}
