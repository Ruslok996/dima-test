<?php

namespace App\MessageHandler;

use App\Message\Message;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class MessageHandler implements MessageHandlerInterface
{
    public function __construct(public UserRepository $userRepository)
    {
    }

    public function __invoke(Message $message)
    {
        $userId = $message->getUserId();
        $this->userRepository->exec($userId);
    }
}
