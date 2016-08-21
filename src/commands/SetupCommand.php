<?php namespace Resizer\Commands;

use Resizer\Schema\ImagesTable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupCommand extends Command
{

    public function configure()
    {
        $this->setName('setup')
            ->setDescription('Do some magic')
        ->addArgument('action',null,'what to do','create');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        if($input->getArgument('action') === 'create')
            (new ImagesTable)->create();
        else
            (new ImagesTable)->drop();

        $output->writeln('<info>Done</info>');

    }

}