<?php namespace App\BokaKanot\Interfaces;

interface KlarnaBillingInterface
{
    public function checkout($cart, $name, $address, $postal_code, $email, $extraRentalDetails);

    public function updateOrder($reservationId, $orderId, $cart, $bookingAddress);

    public function activateOrderProduct($reservationId, $product_number, $quantity);

    public function activateOrderProducts($reservationId, $products);

    public function selectedProductsByInvoice($products);

    public function getSelectedProductIdsFromCommaList($products);

    public function getProductArrayFromCommaList($reservationId);

    public function refundOrderProducts($invoiceId, $productsd);

    public function refundOrderProduct($quantity, $invoiceId, $product_number);

    public function activateOrder($klarna_reservationId);

    public function retrieveCheckout($orderId);

    public function notifyKlarnaOrderStatus($order);

    public function cancel($klarna_reservationId);

    public function credit($invNo);
}

