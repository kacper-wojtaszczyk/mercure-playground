<?php

declare(strict_types=1);

namespace App\Application\Port\Cli;

use App\Application\Port\Notification\SummaryNotification;
use App\Domain\Product\Status;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(name: 'app:product:create', description: 'Create a new product')]
final class CreateProduct extends Command
{
    public function __construct(
        private readonly HubInterface $hub,
        private readonly SerializerInterface $serializer,
        private readonly string $baseUrl,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('send something')
            ->addArgument('factory', InputArgument::REQUIRED)
            ->addArgument('status', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->hub->publish(new Update(
            $this->baseUrl . '/notifications/product/factory/' . $input->getArgument('factory'),
            $this->serializer->serialize(
                new SummaryNotification(Status::from($input->getArgument('status'))),
                'json'
            ),
            true,
        ));

        return Command::SUCCESS;
    }
}
