<?php
namespace App\Utils;

class Storage {
    const TICKETS_KEY = "ticketapp_tickets_v1";
    const SESSION_KEY = "ticketapp_session";

    public static function getSession() {
        return Session::get(self::SESSION_KEY);
    }

    public static function setSession($sessionObj) {
        Session::set(self::SESSION_KEY, $sessionObj);
    }

    public static function clearSession() {
        Session::remove(self::SESSION_KEY);
    }

    // Tickets storage
    public static function getTickets() {
        $tickets = Session::get(self::TICKETS_KEY, []);
        return is_array($tickets) ? $tickets : [];
    }

    public static function saveTickets($tickets) {
        Session::set(self::TICKETS_KEY, $tickets);
    }

    public static function createTicket($ticket) {
        $tickets = self::getTickets();
        $ticket['id'] = (string) time();
        array_unshift($tickets, $ticket);
        self::saveTickets($tickets);
        return $ticket;
    }

    public static function updateTicket($id, $changes) {
        $tickets = self::getTickets();
        foreach ($tickets as &$ticket) {
            if ($ticket['id'] === $id) {
                $ticket = array_merge($ticket, $changes);
                self::saveTickets($tickets);
                return $ticket;
            }
        }
        throw new \Exception("Ticket not found");
    }

    public static function deleteTicket($id) {
        $tickets = self::getTickets();
        $tickets = array_filter($tickets, function($ticket) use ($id) {
            return $ticket['id'] !== $id;
        });
        self::saveTickets(array_values($tickets));
    }
}