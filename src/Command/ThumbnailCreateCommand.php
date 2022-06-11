<?php

namespace App\Command;

use App\HostingStrategy\HostingContext;
use App\HostingStrategy\Strategy\BucketSHosting;
use App\HostingStrategy\Strategy\DropboxHosting;
use App\HostingStrategy\Strategy\HostingInterface;
use App\HostingStrategy\Strategy\LocalHosting;
use App\PictureManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'thumbnail:create',
    description: 'Add a short description for your command',
)]
class ThumbnailCreateCommand extends Command
{
    private array $hostingList = ['Dropbox', 'Bucket', 'Local'];

    protected function configure(): void
    {
        $this
            ->addArgument('image', InputArgument::OPTIONAL, "URL to image (use '')")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (empty($input->getArgument('image'))) {
            $output->writeln("Provide image URL (use '')");
            return 1;
        }
        $host = $this->selectHost($input, $output);
        $strategy = $this->selectStrategy($host);

//        $file = 'https://images.unsplash.com/photo-1579353977828-2a4eab540b9a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1548&q=80';
        $file = $input->getArgument('image');
        $resizer = new PictureManager();
        $image = $resizer->resizeFile($file);

        $context = new HostingContext($strategy);
        $filePath = $context->handle($image);
        $output->writeln('File path: ' . $filePath);

        return Command::SUCCESS;
    }

    public function selectHost(InputInterface $input, OutputInterface $output) :string
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Choose hosting',
            $this->hostingList,
            0
        );
        $question->setErrorMessage('Hosting %s is invalid.');

        $host = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: ' . $host);
        return $host;
    }

    public function selectStrategy($host) :HostingInterface
    {
        if ($host == $this->hostingList[0]) {
            $strategy = new DropboxHosting();
        } elseif ($host == $this->hostingList[1]) {
            $strategy = new BucketSHosting();
        } elseif ($host == $this->hostingList[2]) {
            $strategy = new LocalHosting();
        }

        return $strategy;
    }
}
