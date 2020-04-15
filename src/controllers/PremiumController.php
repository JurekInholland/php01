<?php

class PremiumController extends Controller {

    public function index() {
        return self::view("premium/index");
    }

    public function plus() {

        $id = mt_rand(1, 9);
        while (strlen($id) < 8) {
          $id .= mt_rand(0, 9);
        }

        PaymentService::createPayment(9, $id);
    }

    public function pro() {
        $id = mt_rand(1, 9);
        while (strlen($id) < 8) {
          $id .= mt_rand(0, 9);
        }
        PaymentService::createPayment(29, $id);

    }

}
