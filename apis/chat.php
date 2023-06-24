<?php
use ElephantIO\Client, ElephantIO\Engine\SocketIO\Version1X;

require __DIR__ . '/vendor/autoload.php';

class foo{
  public function tester() {
     $client = new Client(new Version1X('http://www.textbasedmafiagame.com:8080'));
     $client->initialize();
     $client->emit('broadcast2', ['foo' => 'utførte et biltyveri']);
    $client->close();
  }

}
?>