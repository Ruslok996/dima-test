<?php

namespace App\Message;

final class Message
{

     private $userId;

     public function __construct(string $userId)
     {
         $this->userId = $userId;
     }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
