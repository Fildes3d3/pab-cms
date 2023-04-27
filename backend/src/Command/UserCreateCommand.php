<?php

namespace App\Command;

use App\Services\UserManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'pab:create-user',
    description: 'Creates a new user.',
    aliases: ['pab:add-user'],
    hidden: false
)]
class UserCreateCommand extends Command
{
    public function __construct(
        private readonly UserManager $userManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'the email for the new user')
            ->addArgument('password', InputArgument::REQUIRED, 'The password for the new user')
            ->addArgument('roles', InputArgument::IS_ARRAY, 'Roles for the new user')
            ->addOption(
                'first_name',
                null,
                InputArgument::OPTIONAL,
                'The first name for the new user',
                'John'
            )
            ->addOption(
                'last_name',
                null,
                InputArgument::OPTIONAL,
                'The last name for the new user',
                'Doe'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->userManager->create(
            $input->getArgument('email'),
            $input->getArgument('password'),
            $input->getArgument('roles'),
            $input->getOption('first_name'),
            $input->getOption('last_name')
        );

        if (null === $user) {
            $output->writeln(sprintf(
                '<error>Unable to create user with email "%s" as the email is already taken.</error>',
                $input->getArgument('email')
            ));

            return Command::FAILURE;
        }

        $output->writeln('User successfully created!');

        return Command::SUCCESS;
    }
}
