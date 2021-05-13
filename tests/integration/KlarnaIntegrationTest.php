    <?php

use App\BokaKanot\Billing\BillingNotifier;
use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetails;
use App\BokaKanot\Klarna;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
    use App\BokaKanot\Repositories\ProductRepository;

    use App\BokaKanot\PricingUtil;

/*class KlarnaClass
{
    public function __construct(KlarnaDatabaseInterface $klarnaDatabase) {

    }
}*/

class KlarnaIntegrationTest extends TestCase
{
    //use DatabaseTransactions;

   /* public function tearDown()
    {
        Mockery::close();
    }*/

    public function setUp()
    {
        $this->klarnaDatabaseMock = Mockery::mock('App\BokaKanot\KlarnaDatabase')->makePartial();
        $this->klarnaServiceMock = Mockery::mock('App\BokaKanot\KlarnaService')->makePartial();
        $this->billingNotifierMock = Mockery::mock('App\BokaKanot\Interfaces\BillingNotifierInterface');
        $this->KlarnaAdminNotifierBookingDetailsAbstract = Mockery::mock('App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract');
        $this->Klarna = new App\BokaKanot\Klarna($this->klarnaDatabaseMock, $this->klarnaServiceMock, $this->billingNotifierMock);

        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->klarnaDatabaseMock);
        unset($this->klarnaServiceMock);
        unset($this->billingNotifierMock);
        unset($this->KlarnaAdminNotifierBookingDetailsAbstract);
        unset($this->Klarna);
        Mockery::close();
        //parent::tearDown();


    }

    function test_an_integration_test()
    {

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $klarnaDatabaseMock = Mockery::mock('App\BokaKanot\KlarnaDatabase');
        $klarnaServiceMock = Mockery::mock('App\BokaKanot\Interfaces\BillingInterface')->makePartial();
        $billingNotifierMock = Mockery::mock('App\BokaKanot\Interfaces\BillingNotifierInterface');
        $KlarnaAdminNotifierBookingDetailsAbstract = Mockery::mock('App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract');

        $orderId = '123';
        $reservationId = '555';
        $bookingId = 7;

        $klarnaServiceMock->shouldReceive('retrieveCheckout')->once()->andReturn([
            'status' => "checkout_complete",
            "reservation" => "555",
            "gui" => [
                "snippet" => "MockSnippet"
            ]
        ]);

        // put back in when notify is fixed $billingNotifierMock->shouldReceive('notifyAdmin')->once()->andReturn(json_encode(array('error' => false, 'message' => 'Successfully sent.')));
        $klarnaServiceMock->shouldReceive('notifyKlarnaOrderStatus')->once();

        $Klarna = new App\BokaKanot\Klarna($klarnaDatabaseMock, $klarnaServiceMock, $billingNotifierMock);
        $snippet = $Klarna->confirmBooking($orderId, $bookingId, $KlarnaAdminNotifierBookingDetailsAbstract);

        $this->assertEquals($snippet, "MockSnippet");
        //see evidence in the database

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'klarna_orderId' => '123',
            'klarna_reservationId' => $reservationId
        ]);

        $klarnaDatabaseMock->shouldReceive('getReservationNumber')->once()->andReturn($reservationId);
        $invoiceId = "9999";

        $klarnaServiceMock->shouldReceive('activateOrder')->once()->andReturn($invoiceId);

        $this->assertEquals($reservationId, $reservationId);
        $Klarna->activateBooking($bookingId);

        //Asset that invoice id = $invoiceId where $bookingId on booking table

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'klarna_orderId' => '123',
            'klarna_reservationId' => $reservationId,
            'status' => 3,
        ]);



        $klarnaServiceMock->shouldReceive('refundOrderProduct')->once()->andReturn(1);

        //$klarnaDatabaseM  ock->shouldReceive('updateOrderProducts_Status')->once()->andReturn($reservationId);


        $Klarna->refundProduct($invoiceId, 1, $bookingId);

        //klarna_invoiceId has now changed, didn't update the below, so it may fail
        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 4,
            'booking_invoice_id' => $invoiceId
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 4
        ]);

    }

    /** @test */
    function can_activate_individual_product ()
    {
        $orderId = '123';
        $reservationId = '555';
        $bookingId = 8;
        $invoiceId = "7777";

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $this->klarnaServiceMock->shouldReceive('activateOrderProduct')->once()->andReturn($invoiceId);



        $this->Klarna->activateAProduct(1, $reservationId, $bookingId, $price);


        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 3,
            'booking_invoice_id' => "7777"
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 3
        ]);

    }


    /** @test */
    function can_refund_selected_products()
    {
        $orderId = '123';
        $reservationId = '555';
        $bookingId = 8;
        $invoiceId = "7777";

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $this->klarnaServiceMock->shouldReceive('refundOrderProducts')->once()->andReturn($invoiceId);
        /*"1|1"
        "1002459010"
        "152"*/
        $this->Klarna->refundSelectedProducts("1|1|$invoiceId", $bookingId);

        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 4,
            'product_id' => 1
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 4
        ]);
    }

    /** @test */
    function can_activate_selected_products()
    {
        $orderId = '123';
        $reservationId = '555';
        $bookingId = 8;
        $invoiceId = "7777";

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $this->klarnaServiceMock->shouldReceive('activateOrderProducts')->once()->andReturn($invoiceId);
        /*"1|1"
        "1002459010"
        "152"*/
        $this->Klarna->activateSelectedProducts("1|1", $invoiceId, $bookingId);

        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 3,
            'booking_invoice_id' => $invoiceId
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 3
        ]);
    }

    /** @test */
    function can_cancel_whole_booking()
    {
        $orderId = '123';
        $reservationId = '555';
        $bookingId = 8;
        $invoiceId = "7777";

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $this->klarnaServiceMock->shouldReceive('cancel')->once()->andReturn($invoiceId);
        /*"1|1"
        "1002459010"
        "152"*/
        $this->Klarna->cancel($bookingId);

        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 4,
            'product_id' => 1
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 4
        ]);
    }

    /** @test */
    function can_credit_whole_activated_bookings()
    {
        $orderId = '123';
        $reservationId = '555';
        $bookingId = 8;
        $invoiceId = "7777";

        /* reset bookings to status 3 */
        //$this->Klarna->klarnaDatabase->updateStatus($bookingId, 3);

        $user = factory(App\User::class)->create();

        $this->actingAs($user); //set authenticated user to this user

        $this->klarnaServiceMock->shouldReceive('credit')->once()->andReturn($invoiceId);
        /*"1|1"
        "1002459010"
        "152"*/
        $this->Klarna->credit($bookingId, $invoiceId);

        $this->seeInDatabase('booking_product', [

            'booking_id' => $bookingId,
            'klarna_product_status' => 5,
            'product_id' => 1
        ]);

        $this->seeInDatabase('bookings', [

            'id' => $bookingId,
            'status' => 5
        ]);
    }
    /** @test */
    function it_sends_an_email()
    {
        //$KlarnaAdminNotifierBookingDetailsAbstract = Mockery::mock('App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract');

        $klarnaAdminNotifierBookingDetails = new KlarnaAdminNotifierBookingDetails(
            "Mickey Mouse",
            "12 The Street",
            "12045",
            "MickyMouse@Disney.com",
            [],
            "subj - Booking made by MickeyMouse ",
            1200,
            [ "bookings@JamesCanoes.com" ]);

        $notifier = new BillingNotifier();
        //$notifier->notifyAdmin($klarnaAdminNotifierBookingDetails);
        
        /*$mock = Mockery::mock('Swift_Mailer');
        $this->app['mailer']->setSwiftMailer($mock);
        $this->call('GET', 'emailtest');*/
    }


}

/*
 * //$klarnaService = App::instance('App\BokaKanot\Interfaces\KlarnaService', $klarnaServiceMock);

        //$klarnaServiceMock->shouldReceive('retrieveCheckout')->once()->andReturn(['test' => 'this']);
//$klarnaDatabaseMock = Mockery::mock('App\BokaKanot\Interfaces\KlarnaDatabaseInterface')->makePartial();
//$klarnaServiceMock->shouldReceive('saveKlarnaOrderIdReservationId')->once();
        //$klarnaDatabase = App::instance('App\BokaKanot\Interfaces\KlarnaService\KlarnaDatabaseInterface', $klarnaDatabaseMock);
        //$klarnaService = App::instance('App\BokaKanot\Interfaces\KlarnaBillingInterface', $klarnaServiceMock);

        ///***** activate booking test:

        //$klarnaDatabaseMock->shouldReceive('getReservationNumber')->once()->andReturn(json_encode(array('error' => false, 'message' => 'Successfully sent.')));

        //This is a unit test, could make own unit tes class for klarnaDatabase? $reservationId = $klarnaDatabaseMock->getReservationNumber($bookingId);


 */