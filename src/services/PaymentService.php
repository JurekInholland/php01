<?php

// Payments using php wrapper of mollie api
// https://github.com/mollie/mollie-api-php/blob/master/examples/payments/create-payment.php

class PaymentService {


    public static function getClient() {
        $config = parse_ini_file("../src/config/api_keys.ini", true);

        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey($config["mollie"]);
        return $mollie;
    }

    public function getPayment($paymentId) {
        $payment = self::getClient()->payments->get($paymentId);
        return $payment;
        
    }

    public static function getInvoiceId($paymentId) {
        $sql = "SELECT invoice_id FROM payments WHERE payment_id=:payment_id LIMIT 1";
        $params = [":payment_id" => $paymentId];
        $id = App::get("db")->query($sql, $params);
        return $id[0]["invoice_id"];
    }

    public function getDbStatus($paymentId) {
        $sql = "SELECT status FROM payments WHERE payment_id=:payment_id LIMIT 1";
        $params = [":payment_id" => $paymentId];
        $status = App::get("db")->query($sql, $params);
        if (isset($status[0])) {
            return $status[0]["status"];
        }
        return "unknown";
    }

    public static function storeStatus(array $order) {
        $sql = "INSERT INTO payments (payment_id, `status`, invoice_id)
        VALUES (:payment_id, :status, :invoice_id)
        ON DUPLICATE KEY UPDATE payment_id=VALUES(payment_id), status=VALUES(status),
        invoice_id=VALUES(invoice_id)";
        
        $params = [":payment_id" => $order["id"], ":status" => $order["status"], ":invoice_id" => $order["invoice_id"]];
        App::get("db")->query($sql, $params);

    }

    public function createPayment(float $price, string $invoiceId) {
        $orderId = time();
        $userId = App::get("user")->getId();
        // Convert passed float to string with two decimal places
        $value = sprintf('%0.2f', $price);

        $payment =  self::getClient()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $value 
            ],
            "description" => "Order #{$orderId}",
            "redirectUrl" => "https://jbaumann.nl/payment/complete/{$orderId}",
            "webhookUrl" => "https://jbaumann.nl/payment/webhook",
            "metadata" => [
                "order_id" => $orderId,
                "userid" => $userId,
                "invoiceid" => $invoiceId,
            ],
        ]);
        $paymentInfo = ["id" => $orderId, "status" => $payment->status, "invoice_id" => $invoiceId];
        self::storeStatus($paymentInfo);

        return header("Location: " . $payment->getCheckoutUrl(), true, 303);
    }

}