<?php
class PaymentController extends Controller {

    // This endpoint is called by mollie once the status of a payment changes
    public function webhook() {
        if (isset($_POST["id"])) {

            // Verify and store new payment status
            $payment = PaymentService::getPayment($_POST["id"]);
            $paymentInfo = ["id" => $payment->metadata->order_id, "status" => $payment->status, "invoice_id" => $payment->metadata->invoiceid];
            PaymentService::storeStatus($paymentInfo);
            
            // If the order was successfully paid, generate invoice
            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                InvoiceService::generate($payment->metadata->userid, $payment->metadata->invoiceid);
                // TicketService::setPaidInvoice($payment->metadata->invoiceid);
            }
        }

        
    }

    public function complete() {
        $paymentId = $_GET["order"];
        $status = PaymentService::getDbStatus($paymentId);
        // $invoiceId = PaymentService::getInvoiceId($paymentId);
        return self::view("partials/message", ["message" => "Payment complete. Status: {$status}"]);
        // return self::view("partials/payment", ["status" => $status, "paymentid" => $paymentId, "invoiceid" => $invoiceId]);
    }
}