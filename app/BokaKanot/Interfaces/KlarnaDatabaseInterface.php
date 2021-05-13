<?php namespace App\BokaKanot\Interfaces;

interface KlarnaDatabaseInterface
{
    public function getReservationNumber($bookingId);

    /*
     * After a fixed amount klarna discount, this is used to update the the invoice in the database
     */
    public function updateInvoiceRecord($invoiceUniqueId, $discountAmount, $discountDescription, $vat);

    public function updateStatus($bookingId, $status);

    public function updateBookingInvoiceId($invoiceId, $reservationNumber, $totalInvoiced);

    /*
     * Update database with response from Klarna->retrieveCheckout
     */
    public function saveKlarnaOrderIdReservationId($orderId, $reservationId, $bookingId, $cartUpdateAllowed);

    public function updateBookingProductInvoiceIdStatus($bookingId, $invoiceId);

    public function getTotalForMainInvoiceInvoice($bookingId);
}

