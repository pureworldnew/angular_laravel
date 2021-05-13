<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    protected $baseUrl = 'http://localhost:8000';

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Registrera ny kanotcentral');

    }
/*
    public function testVisitBooking()
    {
        $this->visit('/admin/booking')
             ->see('Category');

    }*/
}
