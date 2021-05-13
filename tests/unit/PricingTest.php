<?php

use App\BokaKanot\Repositories\ProductRepository;

use App\BokaKanot\PricingUtil;


class PricingTest extends TestCase
{
    /*
    //Lost database on below tests
    function testPricingTests()
    {
        //vendor/bin/phpunit tests/unit/PricingTest.php
        $productRepoMock = Mockery::mock('App\BokaKanot\Repositories\ProductRepository')->makePartial();

        //$startDateTime = '';
        //$endDateTime = '';

        $pricingUtil = new PricingUtil($productRepoMock);
        $price = $pricingUtil->getLowestPrice(1, "2016-04-26 6:0:0", "2016-04-27 9:0:0");
        //$priceList = $pricingUtil->getPrice(1, "2016-04-26 6:0:0", "2016-04-27 9:0:0");
        $this->assertEquals($price, 16);

        $priceList = $pricingUtil->getPrice(1, "2016-04-30 6:0:0", "2016-04-30 8:0:0");

        //PerHour week day
        $this->assertEquals($priceList[1], 18);

        //PerHour weekends
        $this->assertEquals($priceList[2], 16);

        //weekend price not weekend
        $priceList = $pricingUtil->getPrice(1, "2016-04-29 6:0:0", "2016-04-30 9:0:0");
        $this->assertEquals($priceList[2], 0);


        //PerDayWeek
        $priceList = $pricingUtil->getPrice(1, "2016-04-27 9:0:0", "2016-04-28 7:0:0");
        $this->assertEquals($priceList[3], 8);
        $priceList = $pricingUtil->getPrice(1, "2016-04-27 7:0:0", "2016-04-28 9:0:0");
        $this->assertEquals($priceList[3], 16);
        $priceList = $pricingUtil->getPrice(1, "2016-04-27 9:0:0", "2016-04-27 15:0:0");
        $this->assertEquals($priceList[3], 8);
        $priceList = $pricingUtil->getPrice(1, "2016-04-27 9:0:0", "2016-04-28 6:0:0");
        $this->assertEquals($priceList[3], 8);

        //PerDayWeekEnd
        $priceList = $pricingUtil->getPrice(1, "2016-04-30 6:0:0", "2016-04-31 9:0:0");
        $this->assertEquals($priceList[4], 16);

        $priceList = $pricingUtil->getPrice(1, "2016-04-30 7:0:0", "2016-04-31 9:0:0");
        $this->assertEquals($priceList[4], 16);
        $priceList = $pricingUtil->getPrice(1, "2016-04-30 9:0:0", "2016-04-31 15:0:0");
        $this->assertEquals($priceList[4], 16);
        $priceList = $pricingUtil->getPrice(1, "2016-04-30 9:0:0", "2016-04-31 6:0:0");
        $this->assertEquals($priceList[4], 8);

        //PerHourThreeFour
        $priceList = $pricingUtil->getPrice(1, "2016-04-30 6:0:0", "2016-04-30 9:0:0");
        $this->assertEquals($priceList[9], 0);
        $this->assertEquals($priceList[10], 21);

        $priceList = $pricingUtil->getPrice(1, "2016-04-27 6:0:0", "2016-04-27 9:0:0");
        $this->assertEquals($priceList[9], 18);
        $this->assertEquals($priceList[10], 0);

        $priceList = $pricingUtil->getPrice(1, "2016-04-30 5:0:0", "2016-04-30 9:0:0");

        $this->assertEquals($priceList[9], 0);
        $this->assertEquals($priceList[4], 8);

        $priceList = $pricingUtil->getPrice(1, "2016-04-26 6:0:0", "2016-04-27 9:0:0");
        $this->assertEquals($priceList[9], 0);
        $this->assertEquals($priceList[10], 0);

        //jammers

        $priceList = $pricingUtil->getLowestPrice(1, "2016-04-30 9:0:0", "2016-04-31 6:0:0");
        $this->assertEquals($price, 16);

        $price = $pricingUtil->getLowestPrice(1, "2016-04-30 9:0:0", "2016-04-31 15:0:0");
        $this->assertEquals($price, 16);

        //Price per week:
        $priceList = $pricingUtil->getPrice(1, "2016-05-01 9:0:0", "2016-05-08 9:0:0");

        $this->assertEquals($priceList[13], 100);


    }

    //lost database on below tests
    function testDoesntIncludePerProductPrice()
    {
        $productRepoMock = Mockery::mock('App\BokaKanot\Repositories\ProductRepository')->makePartial();

        $pricingUtil = new PricingUtil($productRepoMock);

        //$priceList = $pricingUtil->getPrice(2, "2015-04-12 3:0:0", "2015-04-12 4:0:0");

        //$priceList = $pricingUtil->getPrice(2, "2015-04-12 3:0:0", "2015-04-12 4:0:0");
        //     dd($priceList);
        //dd($priceList);//2015-04-12
        $lowestPrice = $pricingUtil->getLowestPrice(2, "2015-04-12 3:0:0", "2015-04-12 4:0:0");
//dd($lowestPrice);
        $this->assertEquals($lowestPrice, 7);
    }

    //only have this test now - vendor/bin/phpunit --filter testPerWeekPrice tests/unit/PricingTest.php
    function testPerWeekPrice()
    {
        $productRepoMock = Mockery::mock('App\BokaKanot\Repositories\ProductRepository')->makePartial();

        $pricingUtil = new PricingUtil($productRepoMock);

        $priceList = $pricingUtil->getPrice(2, "2015-04-12 3:0:0", "2015-04-12 4:0:0");
        dd($priceList);
        //$lowestPrice = $pricingUtil->getLowestPrice(2, "2015-04-12 3:0:0", "2015-04-12 4:0:0");
        //dd($lowestPrice);
        //$this->assertEquals($lowestPrice, 7);
    }*/

    //only have this test now - vendor/bin/phpunit --filter testPeter tests/unit/PricingTest.php
    function testPeter()
    {

        $this->assertEquals(1,1);
    }


}