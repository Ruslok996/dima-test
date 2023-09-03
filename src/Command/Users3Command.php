<?php

namespace App\Command;

use App\Message\Message;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:users3',
    description: 'Add a short description for your command',
)]
class Users3Command extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    private $messageBus;
    private $userRepository;

    public function __construct(MessageBusInterface $messageBus, UserRepository $userRepository)
    {
        parent::__construct();

        $this->messageBus = $messageBus;
        $this->userRepository = $userRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->userRepository->findAll();
        $users = array_slice($users, 20000,10000);
        foreach ($users as $user) {
            $userId = $user->getId();
            $message = new Message($userId);
            $this->messageBus->dispatch($message);
        }

        return Command::SUCCESS;
    }
}

