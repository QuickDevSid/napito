<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH .'vendor\autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Websocket_controller extends CI_Controller implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        parent::__construct();
        $this->clients = new \SplObjectStorage;
    }

    public function index() {

    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // Send the message to all other clients
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function startChat() {
        $this->load->view('chat_view');
    }
}
