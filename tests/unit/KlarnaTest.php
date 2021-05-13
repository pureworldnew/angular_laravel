<?php 

use App\BokaKanot\Klarna;
use Illuminate\Support\Facades\App;


class Fun
{
    public function bang()
    {

    }
}
class KlarnaTest extends PHPUnit_Framework_TestCase
{
    protected $klarna;

    public function setUp()
    {
        //$this->klarna = new Klarna();

    }

    public function tearDown()
    {
        Mockery::close();
    }

    function test_a_test_can_run ()
    {
        //$this->assertEquals(1,2);

        //$klarnaDatabaseMock = Mockery::mock('App\BokaKanot\KlarnaDatabaseInterface')->makePartial(); //call actual method if nothing mocked
        //$klarnaDatabaseMock->shouldReceive('doIt')->once()->andReturn('mocked'); //mock a method
        //$klarnaDatabaseMock->shouldReceive('doIt')->once()->with([])->andReturn('mocked'); //with params
        //$klarnaDatabaseMock->shouldReceive('doIt')->times(3)->andReturn('mocked'); //mock a method



        $klarnaDatabaseMock = Mockery::mock('App\BokaKanot\KlarnaDatabaseInterface');
        $billingNotifierMock = Mockery::mock('App\BokaKanot\Interfaces\BillingNotifierInterface');
        $klarnaServiceMock = Mockery::mock('App\BokaKanot\Interfaces\KlarnaService');

        $klarnaDatabase = App::instance('App\BokaKanot\KlarnaDatabaseInterface', $klarnaDatabaseMock);
        $billingNotifier = App::instance('App\BokaKanot\Interfaces\BillingNotifierInterface', $billingNotifierMock);
        $klarnaService = App::instance('App\BokaKanot\Interfaces\KlarnaService', $klarnaServiceMock);



       // dd($klarnaDatabase);


        /*$klarna = $this->prophesize(Fun::class);

//dd($klarna);

        $klarna->bar()->shouldBeCalled();
        $klarna->reveal()->bang();*/
        //die(var_dump($klarna->reveal()));

    }
}

