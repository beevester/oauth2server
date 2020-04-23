<?php


namespace App\Controller;


use App\Model\CreateUserHandler;
use App\Model\ExecuteCreateUser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserController extends Command
{
    private CreateUserHandler $handler;

    /**
     * CreateUserCommand constructor.
     * @param CreateUserHandler $handler
     */
    public function __construct(CreateUserHandler $handler)
    {
        parent::__construct();
        $this->handler = $handler;
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Given a password and first name, last name, generates a new user.')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addArgument('firstName', InputArgument::REQUIRED, 'User First Name')
            ->addArgument('lastName', InputArgument::OPTIONAL, 'User LastName Name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $firstName */
        $firstName = $input->getArgument('firstName');
        /** @var string|null $lastName */
        $lastName = $input->getArgument('lastName') ?: null;
        /** @var string $password */
        $password = $input->getArgument('password');

        $command = new ExecuteCreateUser($firstName, $lastName, $password);

        try {
            $identity = $this->handler->handle($command);

            $output->writeln('<info>User Created: </info>');
            $output->writeln('');
            $output->writeln('Id: ' . $identity);
            $output->writeln("Full Name : $firstName $lastName");

            return 0;
        } catch (\Exception $e) {
            $output->writeln("<error>Error: {$e->getMessage()}</error>");

            return -1;
        }
    }
}
