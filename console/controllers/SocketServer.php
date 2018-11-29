<?php
namespace console\controllers;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    /**
     * SocketServer constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "User {$conn->resourceId} disconnect!\n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
        echo "Connection {$conn->resourceId} close with error!\n";
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message {$msg} from {$from->resourceId}\n";

        foreach ($this->clients as $client){
            $client->send($msg);
        }
    }


}