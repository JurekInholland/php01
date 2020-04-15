<?php

class InvoiceService {

    public static function generate(string $userId, string $invoiceId) {

        $sql = "INSERT INTO invoices (`id`, `user_id`, invoice_date)
        VALUES (:id, :userid, :invoice_date)";
        $params = [":id" => $invoiceId, ":userid" => $userId, ":invoice_date" => date('Y-m-d H:i:s')];
        App::get("db")->query($sql, $params);
    }

    public static function getInvoiceTickets(User $user) {

        // Get all tickets of given user that are paid but do not have
        // an invoice associated with them yet
        $sql = "SELECT tickets.*, festival_events.*, cms_users.username FROM tickets
                JOIN festival_events ON tickets.event_id = festival_events.id
                JOIN cms_users ON tickets.user_id = cms_users.id
                WHERE username LIKE :username AND
                WHERE IS_PAID = 1 AND
                WHERE invoice_id = NULL";

        $params = [":username" => $user->getName()];
        $ticketdata = App::get("db")->query($sql, $params);
        $tickets = TicketService::parseTickets($ticketdata);

        $invoice = new Invoice($user, $tickets);
        die(var_dump($invoice));

    } 

    public function getByUserId($id) {
        $sql = "SELECT invoices.id AS invoice_id, cms_customer_data.*, invoices.*, tickets.*, cms_users.*, festival_events.* FROM invoices
        JOIN tickets ON invoices.id = tickets.invoice_id
        LEFT JOIN cms_customer_data ON invoices.user_id = cms_customer_data.user_id
        JOIN festival_events ON tickets.event_id = festival_events.id
        JOIN cms_users ON invoices.user_id = cms_users.id
        WHERE invoices.user_id = :id";

        $params = [":id" => $id];
        $ticketdata = App::get("db")->query($sql, $params);

        if (isset($ticketdata[0])) {
            $invoices = self::createInvoices($ticketdata);
            return $invoices;
        }
    }

    public static function getById($id) {
        $sql = "SELECT invoices.id AS invoice_id, cms_customer_data.*, invoices.*, tickets.*, cms_users.*, festival_events.* FROM invoices
        JOIN tickets ON invoices.id = tickets.invoice_id
        LEFT JOIN cms_customer_data ON invoices.user_id = cms_customer_data.user_id
        JOIN festival_events ON tickets.event_id = festival_events.id
        JOIN cms_users ON invoices.user_id = cms_users.id
        WHERE invoices.id = :id";

        $params = [":id" => $id];
        $ticketdata = App::get("db")->query($sql, $params);

        if (isset($ticketdata[0])) {
            $invoices = self::createInvoices($ticketdata);
            return $invoices[0];
        }
    }

    public static function getAll() {

        // Get all tickets and users of all invoices
        $sql = "SELECT invoices.id AS invoice_id, invoices.*, cms_customer_data.*, tickets.*, cms_users.*, festival_events.* FROM invoices
        JOIN tickets ON invoices.id = tickets.invoice_id
        LEFT JOIN cms_customer_data ON invoices.user_id = cms_customer_data.user_id
        JOIN festival_events ON tickets.event_id = festival_events.id
        JOIN cms_users ON invoices.user_id = cms_users.id";
        
        $ticketdata = App::get("db")->query($sql);

        if (isset($ticketdata)) {
            $invoices = self::createInvoices($ticketdata);
            return $invoices;
        }
        return $invoices ?? [];

    }

    private static function createInvoices(array $ticketdata) {
        $invoices = [];
        $inv = [];

        // Iterate over ticket data
        foreach ($ticketdata as $key => $data) {
            // Create ticket and user objects
            $event = new FestivalEvent($data);
            $data["event"] = $event;

            $ticket = new Ticket($data);
            $customer = new Customer($data);
            // Store tickets sorted by invoice id in new array
            $inv[$data["invoice_id"]]["tickets"][$key] = $ticket;
            $inv[$data["invoice_id"]]["customer"] = $customer;
            $inv[$data["invoice_id"]]["date"] = $data["invoice_date"];
            $inv[$data["invoice_id"]]["id"] = $data["invoice_id"];
        }
        // Iterate over invoice array
        foreach ($inv as $key => $invoiceArray) {
            extract($invoiceArray);
            // Add Invoice object to final array
            // Use array_values here to reset keys of ticket arrays (php is strange)
            $invoiceData = [
                "customer" => $customer,
                "tickets" => array_values($tickets),
                "date" => $date,
                "id" => $id
            ];
            $invoice = new Invoice($invoiceData);
            array_push($invoices, $invoice);
        }
        return $invoices;
    }
}