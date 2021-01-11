<?php

namespace App\Dao;
use App\VO\Mensagem;
Use Pusher\Pusher;
class ChatDaoMysql 
{

    private $channel;
    private $event;
    private $options;
    private $pusher;

    public function __construct()
    {
        $this->channel = 'jobfinder-chat';
        $this->options = array(
          'cluster' => 'eu',
          'useTLS' => true
        );
        $this->pusher = new Pusher(
          'd94eb47625dbc86a8533',
          '974b84a450a36cd30dfe',
          '1135823',
          $this->options
        );
    }

    public function send(Mensagem $mensagem)
    {
        $this->event = 'send-message';
        $this->pusher->trigger($this->channel, $this->event, $mensagem);
    }

}